@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.myReceipt.title') }}
                </div>
                <div class="panel-body">
                    <table class=" table table-bordered table-striped table-hover" id="datatable-My-Receipt">
                        <thead>
                            <tr>
                                <th>
                                    Data
                                </th>
                                <th>
                                    {{ trans('cruds.receipt.fields.value') }}
                                </th>
                                <th>
                                    {{ trans('cruds.receipt.fields.file') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($receipts as $receipt)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($receipt->created_at)->format('d-m-Y') }}</td>
                                <td>{{ $receipt->value }}</td>
                                <td><a target="_new" href="{{ $receipt->file->getUrl() }}">Ver recibo</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
@parent
<script>
        $('#datatable-My-Receipt').DataTable();
</script>
@endsection