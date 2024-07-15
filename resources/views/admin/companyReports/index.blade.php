@extends('layouts.admin')
@section('styles')
<style>
    table {
        width: 100%;
    }

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
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Faturação
                </div>
                <div class="panel-body">
                    <table>
                        <thead>
                            <tr>
                                <th>Condutor</th>
                                <th style="text-align: right;">Uber</th>
                                <th style="text-align: right;">Bolt</th>
                                <th style="text-align: right;">Totais</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($drivers as $driver)
                            @if ($driver->total_uber || $driver->total_bolt)
                            <tr>
                                <td>{{ $driver->name }}</td>
                                <td style="text-align: right;">{{ number_format($driver->total_uber +
                                    $driver->total_tips_uber, 2) }} <small>€</small></td>
                                <td style="text-align: right;">{{ number_format($driver->total_bolt +
                                    $driver->total_tips_bolt, 2) }} <small>€</small></td>
                                <td style="text-align: right;">{{ number_format($driver->total_operators, 2) }}
                                    <small>€</small></td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Totais</th>
                                <th style="text-align: right;">{{ number_format($total_uber, 2) }} <small>€</small></th>
                                <th style="text-align: right;">{{ number_format($total_bolt, 2) }} <small>€</small></th>
                                <th style="text-align: right;">{{ number_format($total_operators, 2) }} <small>€</small>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Balanço
                </div>
                <div class="panel-body">
                    <table>
                        <tbody>
                            <tr>
                                <th>Ganhos</th>
                                <td style="text-align: right;">{{ number_format($total_operators, 2) }} <small>€</small>
                                </td>
                            </tr>
                            <tr>
                                <th>Pagamentos a motoristas</th>
                                <td style="text-align: right;">{{ number_format($payments, 2) }} <small>€</small></td>
                            </tr>
                            <tr>
                                <th>Despesas da empresa</th>
                                <td style="text-align: right;">{{ number_format($company_expenses, 2) }}
                                    <small>€</small></td>
                            </tr>
                            <tr>
                                <th>Rentabilidade</th>
                                <td style="text-align: right;">{{ number_format($profit, 2) }} <small>€</small></td>
                            </tr>
                            <tr>
                                <th>ROI (Return of investment)</th>
                                <td style="text-align: right;">{{ number_format($roi, 0) }} <small>%</small></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @endif
</div>
@endsection