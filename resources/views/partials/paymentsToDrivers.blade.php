<div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation"><a href="#not-send" aria-controls="not-send" role="tab"
                data-toggle="tab">Extratos por enviar</a></li>
        <li role="presentation" class="active"><a href="#send" aria-controls="send" role="tab" data-toggle="tab">Extratos enviados</a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane" id="not-send">
            <div class="table-responsive" style="margin-top: 20px;">
                <table class=" table table-bordered table-striped table-hover datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Condutor</th>
                            <th>Semana</th>
                            <th>Valor</th>
                            <th></th>
                            <th>Selecionar para enviar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notSend as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->driver->name }}</td>
                            <td><span class="badge">{{ $item->week->number }}</span> <small>de {{
                                    \Carbon\Carbon::parse($item->week->start_date)->format('d-m-Y')
                                    }} a {{
                                    \Carbon\Carbon::parse($item->week->end_date)->format('d-m-Y')
                                    }}</small></td>
                            <td>{{ $item->total }}</td>
                            <td><a href="/admin/financial-statements/pdf/{{ $item->id }}/stream" class="btn btn-success btn-sm">Extrato</a></td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="checkboxes" value="{{ $item->id }}"> Enviar
                                    </label>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button style="display: none;" id="paymentButton" onclick="confirmSend()" class="btn btn-success">Confirmar
                envio de extrato</button>
        </div>
        <div role="tabpanel" class="tab-pane active" id="send">
            <div class="table-responsive" style="margin-top: 20px;">
                <table class=" table table-bordered table-striped table-hover datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Condutor</th>
                            <th>Semana</th>
                            <th>Valor</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($send as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->driver->name }}</td>
                            <td><span class="badge">{{ $item->week->number }}</span> <small>de {{
                                    \Carbon\Carbon::parse($item->week->start_date)->format('d-m-Y')
                                    }} a {{
                                    \Carbon\Carbon::parse($item->week->end_date)->format('d-m-Y')
                                    }}</small></td>
                            <td>{{ $item->total }}</td>
                            <td>
                                @if ($item->paid == 0)
                                <button class="btn btn-success btn-sm" id="pay-{{ $item->id }}" onclick="pay({{ $item->id }})" type="button">Pagar</button>
                                @endif
                            </td>
                            <td>
                                <a href="/admin/financial-statements/pdf/{{ $item->id }}" class="btn btn-success btn-sm">Extrato</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>