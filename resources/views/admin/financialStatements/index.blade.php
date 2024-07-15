@extends('layouts.admin')
@section('content')
<div class="content">
    @if ($company_id == 0)
    <div class="alert alert-info" role="alert">
        Selecione uma empresa para ver os seus extratos.
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
    <a href="/admin/financial-statements/driver/0"
        class="btn btn-default {{ $driver_id == null ? 'disabled selected' : '' }}" style="margin-top: 5px;">Todos</a>
    @foreach ($drivers as $d)
    <a href="/admin/financial-statements/driver/{{ $d->id }}"
        class="btn btn-default {{ $driver_id == $d->id ? 'disabled selected' : '' }}" style="margin-top: 5px;">{{
        $d->name }}</a>
    @endforeach
    @if ($total_earnings_after_vat > 0)
    <div class="row" style="margin-top: 5px;">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Atividades por operador
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>UBER</th>
                                <td>{{ $total_earnings_uber }}€</td>
                                @if ($driver)
                                <td>{{ $contract_type_rank ? $contract_type_rank->percent : '' }}%</td>
                                <td>{{ $total_uber }}€</td>
                                @endif
                            </tr>
                            <tr>
                                <th>BOLT</th>
                                <td>{{ $total_earnings_bolt }}€</td>
                                @if ($driver)
                                <td>{{ $contract_type_rank ? $contract_type_rank->percent : '' }}%</td>
                                <td>{{ $total_bolt }}€</td>
                                @endif
                            </tr>
                            <tr>
                                <th>Gorjeta UBER</th>
                                <td>{{ $total_tips_uber }}€</td>
                                @if ($driver)
                                <td>{{ $uber_tip_percent }}%</td>
                                <td>{{ $uber_tip_after_vat }}€</td>
                                @endif
                            </tr>
                            <tr>
                                <th>Gorjeta BOLT</th>
                                <td>{{ $total_tips_bolt }}€</td>
                                @if ($driver)
                                <td>{{ $bolt_tip_percent }}%</td>
                                <td>{{ $bolt_tip_after_vat }}€</td>
                                @endif
                            </tr>
                            <tr>
                                <th>Totais</th>
                                <td>{{ $total_earnings }}€</td>
                                @if ($driver)
                                <td></td>
                                <td>{{ number_format($total_after_vat, 2) }}€</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @if (($electric_expenses && $electric_expenses['value'] > 0) || ($combustion_expenses &&
            $combustion_expenses['value'] > 0))
            <div class="panel panel-default">
                <div class="panel-heading">
                    Abastecimento
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-5">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th></th>
                                        <th style="text-align: right;">Quantidade</th>
                                        <th style="text-align: right;">Custo</th>
                                    </tr>
                                    @if ($electric_expenses)
                                    <tr>
                                        <th>Gastos</th>
                                        <td>{{ $electric_expenses['amount'] }}</td>
                                        <td>{{ $electric_expenses['total'] }}</td>
                                    </tr>
                                    @endif
                                    @if ($combustion_expenses)
                                    <tr>
                                        <th>Gastos</th>
                                        <td>{{ $combustion_expenses['amount'] }}</td>
                                        <td>{{ $combustion_expenses['total'] }}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            @if ($electric_expenses)
                            <h1 class="text-center" style="font-size: 40px; font-weight: 800;">{{
                                number_format($electric_racio, 2) }}%
                            </h1>
                            @endif
                            @if ($combustion_expenses)
                            <h1 class="text-center" style="font-size: 40px; font-weight: 800;">{{
                                number_format($combustion_racio, 2) }}%
                            </h1>
                            @endif
                        </div>
                        <div class="col-md-7">
                            @if ($electric_expenses)
                            <canvas id="electric_racio" style="height: 200px;"></canvas>
                            @endif
                            @if ($combustion_expenses)
                            <canvas id="combustion_racio" style="height: 200px;"></canvas>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Totais
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th></th>
                                <th style="text-align: right;">Créditos</th>
                                @if ($driver)
                                <th style="text-align: right;">Débitos</th>
                                <th style="text-align: right;">Totais</th>
                                @endif
                            </tr>
                            <tr>
                                <th>Ganhos</th>
                                <td>{{ number_format($total_earnings_no_tip, 2) }}€</td>
                                @if ($driver)
                                <td>- {{ number_format($total_earnings_no_tip - $total_earnings_after_vat, 2) }}€</td>
                                <td>{{ number_format($total_earnings_after_vat, 2) }}€</td>
                                @endif
                            </tr>
                            <tr>
                                <th>Gorjetas</th>
                                <td>{{ number_format($total_tips, 2) }}€</td>
                                @if ($driver)
                                <td>- {{ number_format($total_tips - $total_tip_after_vat, 2) }}€</td>
                                <td>{{ number_format($total_tip_after_vat, 2) }}€</td>
                                @endif
                            </tr>
                            @if ($electric_expenses && $electric_expenses['value'] > 0)
                            <tr>
                                <th>Abastecimento elétrico</th>
                                <td></td>
                                @if ($driver)
                                <td>- {{ $electric_expenses['total'] }}</td>
                                <td></td>
                                @endif
                            </tr>
                            @endif
                            @if ($combustion_expenses && $combustion_expenses['value'] > 0)
                            <tr>
                                <th>Abastecimento combustivel</th>
                                <td></td>
                                @if ($driver)
                                <td>- {{ $combustion_expenses['total'] }}</td>
                                <td></td>
                                @endif
                            </tr>
                            @endif
                            @foreach ($adjustments as $adjustment)
                            <tr>
                                <th>{{ $adjustment->name }}</th>
                                <td>{{ $adjustment->type == 'refund' ? '' . $adjustment->amount . '€' : '' }}</td>
                                <td>{{ $adjustment->type == 'deduct' ? '- ' . $adjustment->amount . '€' : '' }}</td>
                                <td></td>
                            </tr>
                            @endforeach
                            @if ($txt_admin > 0)
                                <tr>
                                    <th>Taxa administrativa</th>
                                    <td></td>
                                    <td>- {{ number_format($txt_admin, 2) }}€</td>
                                    <td></td>
                                </tr>
                            @endif
                            <tr>
                                <th>Totais</th>
                                <th style="text-align: right;">{{ number_format($gross_credits, 2) }}€</th>
                                @if ($driver)
                                <th style="text-align: right;">- {{ number_format($gross_debts, 2) }}€</th>
                                <th style="text-align: right;">{{ number_format($final_total, 2) }}€</th>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="pull-left">Valor a pagar: <span style="font-weight: 800;">{{
                            number_format($final_total, 2) }}</span>€</h3>
                            <div class="pull-right">
                                <a target="_new" href="/admin/financial-statements/pdf" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i></a>
                                <a href="/admin/financial-statements/pdf/1" class="btn btn-primary"><i class="fa fa-cloud-download"></i></a>
                            </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Origem dos ganhos
                </div>
                <div class="panel-body">
                    <canvas id="driver_earnings" style="height: 400px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ranking de faturação semanal por motoristas
                </div>
                <div class="panel-body">
                    <canvas id="team_earnings" style="height: 400px"></canvas>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="alert alert-info" style="margin-top: 20px;" role="alert">
        Não temos registo de viagens para este motorista nesta semana.
    </div>
    @endif
    @endif
</div>
@endsection
@section('styles')
<style>
    td {
        text-align: right;
    }

    table {
        font-size: 13px;
    }

    canvas#electric_racio {
        pointer-events: none;
    }
</style>
@endsection
@section('scripts')
@parent
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const team_earnings = {!! $team_earnings !!};
    const labels = [];
    const data = [];
    const backgrounds = [];
    team_earnings.forEach(element => {
        labels.push(element.driver);
        data.push(element.earnings);
        if(element.own){
            backgrounds.push('#605ca8');
        } else {
            backgrounds.push('#00a65a94');
        }
    });
    const ctx1 = document.getElementById('team_earnings');
    new Chart(ctx1, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Valor faturado',
          data: data,
          borderWidth: 1,
          backgroundColor: backgrounds
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true
          }
        },
      }
    });
</script>
<script>
    const ctx2 = document.getElementById('driver_earnings');
    new Chart(ctx2, {
      type: 'doughnut',
      data: {
        labels: ['UBER', 'BOLT', 'GORJETAS'],
        datasets: [{
          label: 'Valor faturado',
          data: [{!! $total_earnings_uber !!}, {!! $total_earnings_bolt !!}, {!! $total_tips !!}],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
      }
    });
</script>
<script>
    const ctx3 = document.getElementById('electric_racio');
    const combustion_racio = {{ $combustion_racio ? $combustion_racio : 0 }};
    const combustion_racio_difference = 100 - combustion_racio;
    const electric_racio = {{ $electric_racio ? $electric_racio : 0 }};
    const electric_racio_difference = 100 - electric_racio;
    new Chart(ctx3, {
      type: 'bar',
      data: {
        labels: ['Rácio'],
        datasets: [
            {
            label: 'Rácio',
            data: [electric_racio],
            backgroundColor: 'lightblue',
            },
            {
            label: '',
            data: [electric_racio_difference],
            backgroundColor: 'transparent',
            },
        ]
      },
      options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Rácio de rentabilidade'
            },
        },
        scales: {
            x: {
                stacked: true,
            },
            y: {
                stacked: true
            }
        }
      }
    });
</script>
<script>
    const ctx4 = document.getElementById('combustion_racio');
    new Chart(ctx4, {
      type: 'bar',
      data: {
        labels: ['Rácio'],
        datasets: [
            {
            label: 'Rácio',
            data: [combustion_racio],
            backgroundColor: 'lightblue',
            },
            {
            label: '',
            data: [combustion_racio_difference],
            backgroundColor: 'transparent',
            },
        ]
      },
      options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Rácio de rentabilidade'
            },
        },
        scales: {
            x: {
                stacked: true,
            },
            y: {
                stacked: true
            }
        }
      }
    });
</script>
@endsection