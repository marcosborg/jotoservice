@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.adjustment.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.adjustments.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.adjustment.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $adjustment->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.adjustment.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $adjustment->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.adjustment.fields.type') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Adjustment::TYPE_RADIO[$adjustment->type] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.adjustment.fields.amount') }}
                                    </th>
                                    <td>
                                        {{ $adjustment->amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.adjustment.fields.percent') }}
                                    </th>
                                    <td>
                                        {{ $adjustment->percent }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.adjustment.fields.start_date') }}
                                    </th>
                                    <td>
                                        {{ $adjustment->start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.adjustment.fields.end_date') }}
                                    </th>
                                    <td>
                                        {{ $adjustment->end_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.adjustment.fields.drivers') }}
                                    </th>
                                    <td>
                                        @foreach($adjustment->drivers as $key => $drivers)
                                            <span class="label label-info">{{ $drivers->code }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.adjustment.fields.company') }}
                                    </th>
                                    <td>
                                        {{ $adjustment->company->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.adjustment.fields.company_expense') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $adjustment->company_expense ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.adjustments.index') }}">
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