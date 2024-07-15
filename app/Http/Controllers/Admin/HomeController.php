<?php

namespace App\Http\Controllers\Admin;

use App\Models\Adjustment;
use App\Models\Card;
use App\Models\CombustionTransaction;
use App\Models\ContractTypeRank;
use App\Models\Driver;
use App\Models\Electric;
use App\Models\ElectricTransaction;
use App\Models\TvdeActivity;
use App\Models\TvdeMonth;
use App\Models\TvdeWeek;
use App\Models\TvdeYear;

class HomeController
{
    public function index()
    {

        if (auth()->user()->hasRole('Driver') && auth()->user()->driver->count() > 0) {
            $user = auth()->user()->load('driver');
            session()->put('driver_id', $user->driver[0]->id);
            session()->put('company_id', $user->driver[0]->company_id);
        }

        $company_id = session()->get('company_id') ?? $company_id = session()->get('company_id');
        $tvde_year_id = session()->get('tvde_year_id') ? session()->get('tvde_year_id') : $tvde_year_id = TvdeYear::orderBy('name')->first()->id;
        if (session()->has('tvde_month_id')) {
            $tvde_month_id = session()->get('tvde_month_id');
        } else {
            $tvde_month = TvdeMonth::orderBy('number', 'desc')
                ->whereHas('weeks', function ($week) use ($company_id) {
                    $week->whereHas('tvdeActivities', function ($tvdeActivity) use ($company_id) {
                        $tvdeActivity->where('company_id', $company_id);
                    });
                })
                ->where('year_id', $tvde_year_id)
                ->first();
            if ($tvde_month) {
                $tvde_month_id = $tvde_month->id;
            } else {
                $tvde_month_id = 0;
            }
        }
        if (session()->has('tvde_week_id')) {
            $tvde_week_id = session()->get('tvde_week_id');
        } else {
            $tvde_week = TvdeWeek::orderBy('number', 'desc')->where('tvde_month_id', $tvde_month_id)->first();
            if ($tvde_week) {
                $tvde_week_id = $tvde_week->id;
                session()->put('tvde_week_id', $tvde_week->id);
            } else {
                $tvde_week_id = 1;
            }
        }
        $driver_id = session()->get('driver_id') ? session()->get('driver_id') : $driver_id = 0;

        $tvde_years = TvdeYear::orderBy('name')
            ->whereHas('months', function ($month) use ($company_id) {
                $month->whereHas('weeks', function ($week) use ($company_id) {
                    $week->whereHas('tvdeActivities', function ($tvdeActivity) use ($company_id) {
                        $tvdeActivity->where('company_id', $company_id);
                    });
                });
            })
            ->get();
        $tvde_months = TvdeMonth::orderBy('number', 'asc')
            ->whereHas('weeks', function ($week) use ($company_id) {
                $week->whereHas('tvdeActivities', function ($tvdeActivity) use ($company_id) {
                    $tvdeActivity->where('company_id', $company_id);
                });
            })
            ->where('year_id', $tvde_year_id)->get();

        $tvde_weeks = TvdeWeek::orderBy('number', 'asc')
            ->whereHas('tvdeActivities', function ($tvdeActivity) use ($company_id) {
                $tvdeActivity->where('company_id', $company_id);
            })
            ->where('tvde_month_id', $tvde_month_id)->get();

        $drivers = Driver::where('company_id', $company_id)
            ->where('state_id', 1)
            ->get();
        if ($driver_id != 0) {
            $driver = Driver::find($driver_id)->load([
                'contract_type',
                'contract_vat'
            ]);
        } else {
            $driver = null;
        }

        $tvde_week = TvdeWeek::find($tvde_week_id);

        if ($driver_id == 0) {
            $bolt_activities = TvdeActivity::where([
                'tvde_week_id' => $tvde_week_id,
                'tvde_operator_id' => 2,
                'company_id' => $company_id,
            ])
                ->get();

            $uber_activities = TvdeActivity::where([
                'tvde_week_id' => $tvde_week_id,
                'tvde_operator_id' => 1,
                'company_id' => $company_id,
            ])
                ->get();
        } else {
            $bolt_activities = TvdeActivity::where([
                'tvde_week_id' => $tvde_week_id,
                'tvde_operator_id' => 2,
                'driver_code' => $driver->bolt_name,
                'company_id' => $company_id,
            ])
                ->get();

            $uber_activities = TvdeActivity::where([
                'tvde_week_id' => $tvde_week_id,
                'tvde_operator_id' => 1,
                'driver_code' => $driver->uber_uuid,
                'company_id' => $company_id,
            ])
                ->get();
        }

        $adjustments = Adjustment::whereHas('drivers', function ($query) use ($driver_id) {
            $query->where('id', $driver_id);
        })
            ->where('company_id', $company_id)
            ->where(function ($query) use ($tvde_week) {
                $query->where('start_date', '<=', $tvde_week->start_date)
                    ->orWhereNull('start_date');
            })
            ->where(function ($query) use ($tvde_week) {
                $query->where('end_date', '>=', $tvde_week->end_date)
                    ->orWhereNull('end_date');
            })
            ->get();

        $refund = 0;
        $deduct = 0;

        foreach ($adjustments as $adjustment) {
            switch ($adjustment->type) {
                case 'refund':
                    $refund = $refund + $adjustment->amount;
                    break;
                case 'deduct':
                    $deduct = $deduct + $adjustment->amount;
                    break;
            }
        }

        // FUEL EXPENSES

        $electric_expenses = null;
        if ($driver && $driver->electric_id) {
            $electric = Electric::find($driver->electric_id);
            if ($electric) {
                $electric_transactions = ElectricTransaction::where([
                    'card' => $electric->code,
                    'tvde_week_id' => $tvde_week_id
                ])->get();
                $electric_expenses = collect([
                    'amount' => number_format($electric_transactions->sum('amount'), 2, '.', '') . ' kWh',
                    'total' => number_format($electric_transactions->sum('total'), 2, '.', '') . ' €',
                    'value' => $electric_transactions->sum('total')
                ]);
            }
        }
        $combustion_expenses = null;
        if ($driver && $driver->card_id) {
            $card = Card::find($driver->card_id);
            if (!$card) {
                $code = 0;
            } else {
                $code = $card->code;
            }
            $combustion_transactions = CombustionTransaction::where([
                'card' => $code,
                'tvde_week_id' => $tvde_week_id
            ])->get();
            $combustion_expenses = collect([
                'amount' => number_format($combustion_transactions->sum('amount'), 2, '.', '') . ' L',
                'total' => number_format($combustion_transactions->sum('total'), 2, '.', '') . ' €',
                'value' => $combustion_transactions->sum('total')
            ]);
        }

        $total_earnings_bolt = number_format($bolt_activities->sum('earnings_two') - $bolt_activities->sum('earnings_one'), 2);
        $total_tips_bolt = number_format($bolt_activities->sum('earnings_one'), 2);
        $total_earnings_uber = number_format($uber_activities->sum('earnings_two') - $uber_activities->sum('earnings_one'), 2);
        $total_tips_uber = number_format($uber_activities->sum('earnings_one'), 2);
        $total_tips = $total_tips_uber + $total_tips_bolt;
        $total_earnings = $bolt_activities->sum('earnings_two') + $uber_activities->sum('earnings_two');
        $total_earnings_no_tip = ($bolt_activities->sum('earnings_two') - $bolt_activities->sum('earnings_one')) + ($uber_activities->sum('earnings_two') - $uber_activities->sum('earnings_one'));

        //CHECK PERCENT
        $contract_type_ranks = $driver ? ContractTypeRank::where('contract_type_id', $driver->contract_type_id)->get() : [];
        $contract_type_rank = count($contract_type_ranks) > 0 ? $contract_type_ranks[0] : null;
        foreach ($contract_type_ranks as $value) {
            if ($value->from <= $total_earnings && $value->to >= $total_earnings) {
                $contract_type_rank = $value;
            }
        }

        //

        $total_bolt = ($bolt_activities->sum('earnings_two') - $bolt_activities->sum('earnings_one')) * ($contract_type_rank ? $contract_type_rank->percent / 100 : 0);
        $total_uber = ($uber_activities->sum('earnings_two') - $uber_activities->sum('earnings_one')) * ($contract_type_rank ? $contract_type_rank->percent / 100 : 0);

        $total_earnings_after_vat = $total_bolt + $total_uber;

        $total_bolt = number_format(($bolt_activities->sum('earnings_two') - $bolt_activities->sum('earnings_one')) * ($contract_type_rank ? $contract_type_rank->percent / 100 : 0), 2);
        $total_uber = number_format(($uber_activities->sum('earnings_two') - $uber_activities->sum('earnings_one')) * ($contract_type_rank ? $contract_type_rank->percent / 100 : 0), 2);

        $bolt_tip_percent = $driver ? 100 - $driver->contract_vat->tips : 100;
        $uber_tip_percent = $driver ? 100 - $driver->contract_vat->tips : 100;

        $bolt_tip_after_vat = number_format($total_tips_bolt * ($bolt_tip_percent / 100), 2);
        $uber_tip_after_vat = number_format($total_tips_uber * ($uber_tip_percent / 100), 2);

        $total_tip_after_vat = $bolt_tip_after_vat + $uber_tip_after_vat;

        $total = $total_earnings + $total_tips;
        $total_after_vat = $total_earnings_after_vat + $total_tip_after_vat;

        $gross_credits = $total_earnings_no_tip + $total_tips + $refund;
        $gross_debts = ($total_earnings_no_tip - $total_earnings_after_vat) + ($total_tips - $total_tip_after_vat) + $deduct;

        $final_total = $gross_credits - $gross_debts;

        $electric_racio = null;
        $combustion_racio = null;

        if ($electric_expenses && $total_earnings > 0) {
            $final_total = $final_total - $electric_expenses['value'];
            $gross_debts = $gross_debts + $electric_expenses['value'];
            if ($electric_expenses['value'] > 0) {
                $electric_racio = ($electric_expenses['value'] / $total_earnings) * 100;
            } else {
                $electric_racio = 0;
            }
        }
        if ($combustion_expenses && $total_earnings > 0) {
            $final_total = $final_total - $combustion_expenses['value'];
            $gross_debts = $gross_debts + $combustion_expenses['value'];
            if ($combustion_expenses['value'] > 0) {
                $combustion_racio = ($combustion_expenses['value'] / $total_earnings) * 100;
            } else {
                $combustion_racio = 0;
            }
        }

        if ($driver && $driver->contract_vat->percent && $driver->contract_vat->percent > 0) {
            $txt_admin = ($final_total * $driver->contract_vat->percent) / 100;
            $gross_debts = $gross_debts + $txt_admin;
            $final_total = $final_total - $txt_admin;
        } else {
            $txt_admin = 0;
        }

        //GRAFICOS

        $team_earnings = collect();

        foreach ($drivers as $key => $d) {
            $team_driver_bolt_earnings = TvdeActivity::where([
                'tvde_week_id' => $tvde_week_id,
                'tvde_operator_id' => 2,
                'driver_code' => $d->bolt_name
            ])
                ->get()->sum('earnings_two');

            $team_driver_uber_earnings = TvdeActivity::where([
                'tvde_week_id' => $tvde_week_id,
                'tvde_operator_id' => 1,
                'driver_code' => $d->uber_uuid
            ])
                ->get()->sum('earnings_two');

            $team_driver_earnings = $team_driver_bolt_earnings + $team_driver_uber_earnings;
            if ($driver) {
                $entry = collect([
                    'driver' => $driver->uber_uuid == $d->uber_uuid || $driver->bolt_name == $d->bolt_name ? $driver->name : 'Motorista ' . $key + 1,
                    'earnings' => sprintf("%.2f", $team_driver_earnings),
                    'own' => $driver->uber_uuid == $d->uber_uuid || $driver->bolt_name == $d->bolt_name
                ]);
                $team_earnings->add($entry);
            }
        }

        return view('home', compact([
            'company_id',
            'tvde_year_id',
            'tvde_years',
            'tvde_months',
            'tvde_month_id',
            'tvde_weeks',
            'tvde_week_id',
            'drivers',
            'driver_id',
            'bolt_activities',
            'uber_activities',
            'total_earnings_uber',
            'contract_type_rank',
            'total_uber',
            'total_earnings_bolt',
            'total_bolt',
            'total_tips_uber',
            'uber_tip_percent',
            'uber_tip_after_vat',
            'total_tips_bolt',
            'bolt_tip_percent',
            'bolt_tip_after_vat',
            'total_tips',
            'total_tip_after_vat',
            'adjustments',
            'total_earnings',
            'total_earnings_no_tip',
            'total',
            'total_after_vat',
            'gross_credits',
            'gross_debts',
            'final_total',
            'driver',
            'team_earnings',
            'electric_expenses',
            'combustion_expenses',
            'combustion_racio',
            'electric_racio',
            'total_earnings_after_vat',
            'txt_admin'
        ]));
    }

    public function selectCompany($company_id)
    {
        session()->forget('driver_id');
        session()->put('company_id', $company_id);
    }
}