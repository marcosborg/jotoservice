@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.combustionTransaction.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.combustion-transactions.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.combustionTransaction.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $combustionTransaction->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.combustionTransaction.fields.tvde_week') }}
                                    </th>
                                    <td>
                                        {{ $combustionTransaction->tvde_week->start_date ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.combustionTransaction.fields.card') }}
                                    </th>
                                    <td>
                                        {{ $combustionTransaction->card }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.combustionTransaction.fields.amount') }}
                                    </th>
                                    <td>
                                        {{ $combustionTransaction->amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.combustionTransaction.fields.total') }}
                                    </th>
                                    <td>
                                        {{ $combustionTransaction->total }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.combustion-transactions.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection