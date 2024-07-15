<div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        @php
        $count = 1;
        $total = $years->count();
        @endphp
        @foreach ($years as $year)
        <li role="presentation" class="{{ $count++ == $total ? 'active' : '' }}"><a href="#year-{{ $year->id }}"
                aria-controls="year-{{ $year->id }}" role="tab" data-toggle="tab">{{ $year->name }}</a></li>
        @endforeach
    </ul>
    <!-- Tab panes -->
    <div class="tab-content" style="margin-top: 20px;">
        @php
        $count = 1;
        $total = $years->count();
        @endphp
        @foreach ($years as $year)
        <div role="tabpanel" class="tab-pane {{ $count++ == $total ? 'active' : '' }}" id="year-{{ $year->id }}">
            <div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    @php
                    $monthCount = 1;
                    $monthTotal = $year->months->count();
                    @endphp
                    @foreach ($year->months as $month)
                    <li role="presentation" class="{{ $monthCount++ == $monthTotal ? 'active' : '' }}"><a
                            href="#month-{{ $month->id }}" aria-controls="month-{{ $month->id }}" role="tab"
                            data-toggle="tab">{{
                            $month->name }}</a></li>
                    @endforeach
                </ul>
                <!-- Tab panes -->
                <div class="tab-content" style="margin-top: 20px;">
                    @php
                    $monthCount = 1;
                    $monthTotal = $year->months->count();
                    @endphp
                    @foreach ($year->months as $month)
                    <div role="tabpanel" class="tab-pane {{ $monthCount++ == $monthTotal ? 'active' : '' }}"
                        id="month-{{ $month->id }}">
                        <div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                @php
                                $weekCount = 1;
                                $weekTotal = $month->weeks->count();
                                @endphp
                                @foreach ($month->weeks as $week)
                                <li role="presentation" class="{{ $weekCount++ == $weekTotal ? 'active' : '' }}"><a
                                        href="#week-{{ $week->id }}" aria-controls="week-{{ $week->id }}" role="tab"
                                        data-toggle="tab"><span class="badge">Semana {{ $week->number }}</span> de {{ \Carbon\Carbon::parse($week->start_date)->format('d') }} a
                                        {{ \Carbon\Carbon::parse($week->end_date)->format('d') }}</a></li>
                                @endforeach
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content" style="margin-top: 20px;">
                                @php
                                $weekCount = 1;
                                $weekTotal = $month->weeks->count();
                                @endphp
                                @foreach ($month->weeks as $week)
                                <div role="tabpanel" class="tab-pane {{ $weekCount++ == $weekTotal ? 'active' : '' }}"
                                    id="week-{{ $week->id }}">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Condutor</td>
                                                <th>Aluguer</td>
                                                <th>Gestão</th>
                                                <th>Seguro</th>
                                                <th>Combustivel</th>
                                                <th>Portagens</th>
                                                <th>Débitos</th>
                                                <th>Créditos</th>
                                                <th>Operadores</th>
                                                <th>Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($week->activityLaunches as $activityLaunch)
                                            <tr>
                                                <td>{{ $activityLaunch->driver->name }}</td>
                                                <td>{{ $activityLaunch->rent }}</td>
                                                <td>{{ $activityLaunch->management }}</td>
                                                <td>{{ $activityLaunch->insurance }}</td>
                                                <td>{{ $activityLaunch->fuel }}</td>
                                                <td>{{ $activityLaunch->tolls }}</td>
                                                <td>{{ $activityLaunch->others }}</td>
                                                <td>{{ $activityLaunch->refund }}</td>
                                                <td>
                                                    @php
                                                        $sum = [];
                                                    @endphp
                                                    @foreach ($activityLaunch->activityPerOperators as $activityPerOperator)
                                                    @php
                                                        $sum[] = $activityPerOperator->net - $activityPerOperator->taxes;
                                                    @endphp
                                                    <span class="badge">{{ $activityPerOperator->tvde_operator->name
                                                        }}</span>
                                                    @endforeach
                                                </td>
                                                @php
                                                    $sum = array_sum($sum);
                                                    $sub = [
                                                        $activityLaunch->rent,
                                                        $activityLaunch->management,
                                                        $activityLaunch->insurance,
                                                        $activityLaunch->fuel,
                                                        $activityLaunch->tolls,
                                                        $activityLaunch->others
                                                    ];
                                                    $sub = array_sum($sub);
                                                    $total = $sum - $sub + $activityLaunch->refund;
                                                @endphp
                                                <td>
                                                    {{ $total }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-xs btn-info"
                                                        onclick="showActivityLaunch({{ $activityLaunch->id }})">
                                                        Editar
                                                    </button>
                                                    <button type="button" class="btn btn-xs btn-danger"
                                                        onclick="deleteActivityLaunch({{ $activityLaunch->id }})">
                                                        Eliminar
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <button class="btn btn-success" type="button"
                                        onclick="launchActivity({{ $week->id }})">Lançar atividade</button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>