@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.vehicleEvent.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.vehicle-events.update", [$vehicleEvent->id]) }}"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.vehicleEvent.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name"
                                value="{{ old('name', $vehicleEvent->name) }}" required>
                            @if($errors->has('name'))
                            <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleEvent.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.vehicleEvent.fields.description') }}</label>
                            <textarea class="form-control" name="description"
                                id="description">{{ old('description', $vehicleEvent->description) }}</textarea>
                            @if($errors->has('description'))
                            <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleEvent.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('vehicle_event_type') ? 'has-error' : '' }}">
                            <label class="required" for="vehicle_event_type_id">{{
                                trans('cruds.vehicleEvent.fields.vehicle_event_type') }}</label>
                            <select class="form-control select2" name="vehicle_event_type_id" id="vehicle_event_type_id"
                                required>
                                @foreach($vehicle_event_types as $id => $entry)
                                <option value="{{ $id }}" {{ (old('vehicle_event_type_id') ?
                                    old('vehicle_event_type_id') : $vehicleEvent->vehicle_event_type->id ?? '') == $id ?
                                    'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('vehicle_event_type'))
                            <span class="help-block" role="alert">{{ $errors->first('vehicle_event_type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleEvent.fields.vehicle_event_type_helper')
                                }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('vehicle_event_warning_time') ? 'has-error' : '' }}">
                            <label for="vehicle_event_warning_time_id">{{
                                trans('cruds.vehicleEvent.fields.vehicle_event_warning_time') }}</label>
                            <select class="form-control select2" name="vehicle_event_warning_time_id"
                                id="vehicle_event_warning_time_id">
                                @foreach($vehicle_event_warning_times as $id => $entry)
                                <option value="{{ $id }}" {{ (old('vehicle_event_warning_time_id') ?
                                    old('vehicle_event_warning_time_id') : $vehicleEvent->vehicle_event_warning_time->id
                                    ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('vehicle_event_warning_time'))
                            <span class="help-block" role="alert">{{ $errors->first('vehicle_event_warning_time')
                                }}</span>
                            @endif
                            <span class="help-block">{{
                                trans('cruds.vehicleEvent.fields.vehicle_event_warning_time_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                            <label class="required" for="date">{{ trans('cruds.vehicleEvent.fields.date') }}</label>
                            <input class="form-control datetime" type="text" name="date" id="date"
                                value="{{ old('date', $vehicleEvent->date) }}" required>
                            @if($errors->has('date'))
                            <span class="help-block" role="alert">{{ $errors->first('date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleEvent.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('vehicle_item') ? 'has-error' : '' }}">
                            <label class="required" for="vehicle_item_id">{{
                                trans('cruds.vehicleEvent.fields.vehicle_item') }}</label>
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <a href="/admin/vehicle-items/{{ $vehicleEvent->vehicle_item->id }}" class="btn btn-success">Ir para a viatura</a>
                                </div>
                                <select class="form-control select2" name="vehicle_item_id" id="vehicle_item_id"
                                    required>
                                    @foreach($vehicle_items as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('vehicle_item_id') ? old('vehicle_item_id') :
                                        $vehicleEvent->vehicle_item->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('vehicle_item'))
                            <span class="help-block" role="alert">{{ $errors->first('vehicle_item') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleEvent.fields.vehicle_item_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('sent') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="sent" value="0">
                                <input type="checkbox" name="sent" id="sent" value="1" {{ $vehicleEvent->sent ||
                                old('sent', 0) === 1 ? 'checked' : '' }}>
                                <label for="sent" style="font-weight: 400">{{ trans('cruds.vehicleEvent.fields.sent')
                                    }}</label>
                            </div>
                            @if($errors->has('sent'))
                            <span class="help-block" role="alert">{{ $errors->first('sent') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleEvent.fields.sent_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection