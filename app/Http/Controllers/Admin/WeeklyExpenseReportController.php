<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adjustment;
use App\Models\Card;
use App\Models\CombustionTransaction;
use App\Models\CompanyExpense;
use App\Models\ContractTypeRank;
use App\Models\Driver;
use App\Models\Electric;
use App\Models\ElectricTransaction;
use App\Models\TvdeActivity;
use App\Models\TvdeMonth;
use App\Models\TvdeWeek;
use App\Models\TvdeYear;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WeeklyExpenseReportController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('weekly_expense_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $company_id = session()->get('company_id') ?? $company_id = session()->get('company_id');

        // START FILTER

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

        // END FILTER

        $drivers = Driver::where('company_id', $company_id)->get();

        $tvde_week = TvdeWeek::find($tvde_week_id);

        $drivers_payments = [];

        $company_electricity = [];

        foreach ($drivers as $driver) {

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

            $adjustments = Adjustment::whereHas('drivers', function ($query) use ($driver) {
                $query->where('id', $driver->id);
            })
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

            if ($electric_expenses) {
                $final_total = $final_total - $electric_expenses['value'];
                $gross_debts = $gross_debts + $electric_expenses['value'];
                if ($electric_expenses['value'] > 0) {
                    $electric_racio = ($electric_expenses['value'] / $total_earnings) * 100;
                    $company_electricity[] = $electric_expenses['value'];
                } else {
                    $electric_racio = 0;
                }
            }
            if ($combustion_expenses) {
                $final_total = $final_total - $combustion_expenses['value'];
                $gross_debts = $gross_debts + $combustion_expenses['value'];
                if ($combustion_expenses['value'] > 0) {
                    $combustion_racio = ($combustion_expenses['value'] / $total_earnings) * 100;
                } else {
                    $combustion_racio = 0;
                }
            }

            $drivers_payments[] = $final_total;
        }

        $drivers_payment = array_sum($drivers_payments);

        $today = Carbon::today()->toDateString();

        $adjustments = Adjustment::where('company_id', $company_id)
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->where('company_expense', 1)
            ->get()
            ->load('drivers');

        $company_expenses = CompanyExpense::where('company_id', $company_id)
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->get();

        $company_electricity = array_sum($company_electricity);

        return view('admin.weeklyExpenseReports.index', compact([
            'company_id',
            'tvde_years',
            'tvde_year_id',
            'tvde_months',
            'tvde_month_id',
            'tvde_weeks',
            'tvde_week_id',
            'adjustments',
            'company_expenses',
            'drivers_payment',
            'company_electricity'
        ]));
    }

}
