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

class CompanyReportController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('company_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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

        $tvde_week = TvdeWeek::find($tvde_week_id);

        $drivers = Driver::where('company_id', $company_id)
            ->where('state_id', 1)
            ->get()
            ->load([
                'contract_vat',
                'card',
                'electric'
            ]);

        $total_uber = [];
        $total_bolt = [];
        $payments_no_tips = [];
        $tips = [];
        $fuel_transactions = [];
        $total_adjustments = [];
        $company_adjustment = [];
        $total_company_expenses = [];

        foreach ($drivers as $driver) {
            $uber_uuid = $driver->uber_uuid;
            $bolt_name = $driver->bolt_name;
            $uber_activities = TvdeActivity::where('tvde_week_id', $tvde_week_id)
                ->where('tvde_operator_id', 1)
                ->where('driver_code', $uber_uuid)
                ->get();
            $bolt_activities = TvdeActivity::where('tvde_week_id', $tvde_week_id)
                ->where('tvde_operator_id', 2)
                ->where('driver_code', $bolt_name)
                ->get();

            $driver->total_uber = $uber_activities ? $uber_activities->sum('earnings_two') : 0;
            $driver->total_uber_tips = $uber_activities ? $uber_activities->sum('earnings_one') : 0;
            $driver->total_bolt = $bolt_activities ? $bolt_activities->sum('earnings_two') : 0;
            $driver->total_bolt_tips = $uber_activities ? $bolt_activities->sum('earnings_one') : 0;
            $total_uber[] = $driver->total_uber;
            $total_bolt[] = $driver->total_bolt;
            $driver->total_operators = $driver->total_uber + $driver->total_bolt;

            // contract_type_ranks
            $total_no_tips = ($driver->total_uber - $driver->total_uber_tips) + ($driver->total_bolt - $driver->total_bolt_tips);

            $contract_type_rank = ContractTypeRank::where('contract_type_id', $driver->contract_type_id)
                ->where('from', '<=', $total_no_tips > 0 ? $total_no_tips : 0)
                ->where('to', '>=', $total_no_tips > 0 ? $total_no_tips : 0)
                ->first();

            // taxação de ganhos e gorjetas

            if ($contract_type_rank) {
                $total_no_tips = ($total_no_tips * $contract_type_rank->percent) / 100;
            }

            $payments_no_tips[] = $total_no_tips;

            if ($driver->contract_vat->tips !== 0) {
                $tips[] = $driver->total_uber_tips + $driver->total_bolt_tips - (($driver->total_uber_tips + $driver->total_bolt_tips) * ($driver->contract_vat->tips / 100));
            } else {
                $tips[] = $driver->total_uber_tips + $driver->total_bolt_tips;
            }

            // abastecimentos

            if ($driver->card) {
                $combustion_transactions = CombustionTransaction::where([
                    'tvde_week_id' => $tvde_week_id,
                    'card' => $driver->card->code
                ])->sum('total');
                if ($combustion_transactions) {
                    $fuel_transactions[] = $combustion_transactions;
                }
            }

            if ($driver->electric) {
                $electric_transactions = ElectricTransaction::where([
                    'tvde_week_id' => $tvde_week_id,
                    'card' => $driver->electric->code
                ])->sum('total');
                if ($electric_transactions) {
                    $fuel_transactions[] = $electric_transactions;
                }
            }

            // adjustments

            $adjustments = Adjustment::where('company_id', $company_id)
                ->where('start_date', '<=', $tvde_week->start_date)
                ->where('end_date', '>=', $tvde_week->end_date)
                ->whereHas('drivers', function ($adjustment) use ($driver) {
                    $adjustment->where('driver_id', $driver->id);
                })
                ->get();

            foreach ($adjustments as $adjustment) {
                if ($adjustment->type == 'refund') {
                    $total_adjustments[] = (-$adjustment->amount);
                } else {
                    $total_adjustments[] = $adjustment->amount;
                }
                if ($adjustment->company_expense == true) {
                    if ($adjustment->type == 'refund') {
                        $company_adjustment[] = $adjustment->amount;
                    } else {
                        $company_adjustment[] = (-$adjustment->amount);
                    }
                }
            }

        }

        $company_expenses = CompanyExpense::where('start_date', '<=', $tvde_week->start_date)
            ->where('end_date', '>=', $tvde_week->end_date)
            ->where('company_id', $company_id)
            ->get();

        foreach ($company_expenses as $company_expense) {
            $total_company_expenses[] = $company_expense->qty * $company_expense->weekly_value;
        }

        $total_uber = array_sum($total_uber);
        $total_bolt = array_sum($total_bolt);
        $total_operators = $total_uber + $total_bolt;
        $payments_no_tips = array_sum($payments_no_tips);
        $tips = array_sum($tips);
        $fuel_transactions = array_sum($fuel_transactions);
        $total_adjustments = array_sum($total_adjustments);
        $company_expenses = array_sum($company_adjustment) + array_sum($total_company_expenses);
        $payments = $payments_no_tips + $tips - $fuel_transactions - $total_adjustments;
        $profit = $total_operators - $payments - $company_expenses;
        if ($company_id != 0) {
            $roi = (($total_operators - ($payments + $company_expenses)) / ($payments + $company_expenses)) * 100;
        } else {
            $roi = 0;
        }

        return view('admin.companyReports.index', compact([
            'company_id',
            'tvde_years',
            'tvde_year_id',
            'tvde_months',
            'tvde_month_id',
            'tvde_weeks',
            'tvde_week_id',
            'drivers',
            'total_uber',
            'total_bolt',
            'total_operators',
            'payments',
            'company_adjustment',
            'company_expenses',
            'profit',
            'roi'
        ]));

    }

}
