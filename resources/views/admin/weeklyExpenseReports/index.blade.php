@extends('layouts.admin')
@section('styles')
<style>
    tr {
        line-height: 25px;
    }

    tr:nth-child(even) {
        background-color: #eeeeee;
    }

    tr:nth-child(odd) {
        background-color: #ffffff;
    }
</style>
@endsection
@section('content')
<div class="content">

    @if ($company_id == 0)
    <div class="alert alert-info" role="alert">
        Selecione uma empresa para ver os extratos.
    </div>
    @else
    <div class="btn-group btn-group-justified" role="group">
        @foreach ($tvde_years as $tvde_year)
        <a href="/admin/financial-statements/year/{{ $tvde_year->id }}"
            class="btn btn-default {{ $tvde_year->id == $tvde_year_id ? 'disabled selected' : '' }}">{{ $tvde_year->name
            }}</a>
        @endforeach
    </div>
    <div class="btn-group btn-group-justified" role="group" style="margin-top: 5px;">
        @foreach ($tvde_months as $tvde_month)
        <a href="/admin/financial-statements/month/{{ $tvde_month->id }}"
            class="btn btn-default {{ $tvde_month->id == $tvde_month_id ? 'disabled selected' : '' }}">{{
            $tvde_month->name
            }}</a>
        @endforeach
    </div>
    <div class="btn-group btn-group-justified" role="group" style="margin-top: 5px;">
        @foreach ($tvde_weeks as $tvde_week)
        <a href="/admin/financial-statements/week/{{ $tvde_week->id }}"
            class="btn btn-default {{ $tvde_week->id == $tvde_week_id ? 'disabled selected' : '' }}">Semana de {{
            \Carbon\Carbon::parse($tvde_week->start_date)->format('d')
            }} a {{ \Carbon\Carbon::parse($tvde_week->end_date)->format('d') }}</a>
        @endforeach
    </div>
    <div class="panel panel-default" style="margin-top: 20px;">
        <div class="panel-heading">
            Custos operacionais
        </div>
        <div class="panel-body">
            <table style="width: 100%">
                <thead>
                    <tr>
                        <th></th>
                        <th style="text-align: right;">Qtd.</th>
                        <th style="text-align: right;">Unitário</th>
                        <th style="text-align: right;">Semanal</th>
                        <th style="text-align: right;">Mensal</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total_adjustments_unit = [];
                    $total_adjustments_weekly = [];
                    $total_adjustments_monthly = [];
                    @endphp
                    @foreach ($adjustments as $adjustment)
                    <tr>
                        <td>{{ $adjustment->name }}</td>
                        <td style="text-align: right;">{{ $adjustment->drivers->count() }}</td>
                        <td style="text-align: right;">{{ $adjustment->type == 'refund' ? '' : '-' }}{{
                            number_format($adjustment->amount, 2) }} <small>€</small></td>
                        <td style="text-align: right;">{{ $adjustment->type == 'refund' ? '' : '-' }}{{
                            number_format($adjustment->amount *
                            $adjustment->drivers->count(), 2) }} <small>€</small></td>
                        <td style="text-align: right;">{{ $adjustment->type == 'refund' ? '' : '-' }}{{
                            number_format($adjustment->amount *
                            $adjustment->drivers->count() * 4, 2) }} <small>€</small></td>
                    </tr>
                    @php
                    $total_adjustments_unit[] = $adjustment->type == 'refund' ? $adjustment->amount : -
                    $adjustment->amount;
                    $total_adjustments_weekly[] = $adjustment->type == 'refund' ? $adjustment->amount : -
                    $adjustment->amount * $adjustment->drivers->count();
                    $total_adjustments_monthly[] = $adjustment->type == 'refund' ? $adjustment->amount : -
                    $adjustment->amount * $adjustment->drivers->count() * 4;
                    @endphp
                    @endforeach
                    @php
                    $total_company_expenses_unit = [];
                    $total_company_expenses_weekly = [];
                    $total_company_expenses_monthly = [];
                    @endphp
                    @foreach ($company_expenses as $company_expense)
                    <tr>
                        <td>{{ $company_expense->name }}</td>
                        <td style="text-align: right;">{{ $company_expense->qty }}</td>
                        <td style="text-align: right;">{{ number_format($company_expense->weekly_value, 2) }}
                            <small>€</small>
                        </td>
                        <td style="text-align: right;">{{ number_format($company_expense->weekly_value *
                            $company_expense->qty, 2) }} <small>€</small></td>
                        <td style="text-align: right;">{{ number_format($company_expense->weekly_value *
                            $company_expense->qty * 4) }} <small>€</small></td>
                    </tr>
                    @php
                    $total_company_expenses_unit[] = $company_expense->weekly_value;
                    $total_company_expenses_weekly[] = $company_expense->weekly_value * $company_expense->qty;
                    $total_company_expenses_monthly[] = $company_expense->weekly_value * $company_expense->qty * 4;
                    @endphp
                    @endforeach
                    <tr>
                        <th>Total de despesas</th>
                        <th></th>
                        <th style="text-align: right;">{{ number_format(array_sum($total_adjustments_unit) +
                            array_sum($total_company_expenses_unit), 2) }} <small>€</small></th>
                        <th style="text-align: right;">{{ number_format(array_sum($total_adjustments_weekly) +
                            array_sum($total_company_expenses_weekly), 2) }} <small>€</small></th>
                        <th style="text-align: right;">{{ number_format(array_sum($total_adjustments_monthly) +
                            array_sum($total_company_expenses_monthly), 2) }} <small>€</small></th>
                    </tr>
                    <tr>
                        <td>Pagamentos a motoristas</td>
                        <td></td>
                        <td></td>
                        <td style="text-align: right;">{{ number_format($drivers_payment, 2) }} <small>€</small></td>
                        <td></td>
                    </tr>
                    @if ($company_electricity)
                    <tr>
                        <td>Eletricidade</td>
                        <td></td>
                        <td></td>
                        <td style="text-align: right;">{{ number_format($company_electricity, 2) }} <small>€</small>
                        </td>
                        <td></td>
                    </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total final</th>
                        <th></th>
                        <th></th>
                        <th style="text-align: right;">{{ number_format(array_sum($total_adjustments_weekly) +
                            array_sum($total_company_expenses_weekly) + $drivers_payment + $company_electricity, 2) }}
                            <small>€</small></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection