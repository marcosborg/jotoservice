@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.vehicleEvent.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.vehicle-events.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleEvent.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $vehicleEvent->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleEvent.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $vehicleEvent->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleEvent.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $vehicleEvent->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleEvent.fields.vehicle_event_type') }}
                                    </th>
                                    <td>
                                        {{ $vehicleEvent->vehicle_event_type->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleEvent.fields.vehicle_event_warning_time') }}
                                    </th>
                                    <td>
                                        {{ $vehicleEvent->vehicle_event_warning_time->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleEvent.fields.date') }}
                                    </th>
                                    <td>
                                        {{ $vehicleEvent->date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleEvent.fields.vehicle_item') }}
                                    </th>
                                    <td>
                                        <a href="/admin/vehicle-items/{{ $vehicleEvent->vehicle_item->id ?? '' }}" class="btn btn-success btn-sm">{{ $vehicleEvent->vehicle_item->license_plate ?? '' }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleEvent.fields.sent') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $vehicleEvent->sent ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.vehicle-events.index') }}">
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