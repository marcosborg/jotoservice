@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.vehicleEventWarningTime.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.vehicle-event-warning-times.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.vehicleEventWarningTime.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleEventWarningTime.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('days') ? 'has-error' : '' }}">
                            <label class="required" for="days">{{ trans('cruds.vehicleEventWarningTime.fields.days') }}</label>
                            <input class="form-control" type="number" name="days" id="days" value="{{ old('days', '') }}" step="1" required>
                            @if($errors->has('days'))
                                <span class="help-block" role="alert">{{ $errors->first('days') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleEventWarningTime.fields.days_helper') }}</span>
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