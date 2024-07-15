@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.adminContract.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.admin-contracts.update", [$adminContract->id]) }}"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('number') ? 'has-error' : '' }}">
                            <label class="required" for="number">{{ trans('cruds.adminContract.fields.number')
                                }}</label>
                            <input class="form-control" type="number" name="number" id="number"
                                value="{{ old('number', $adminContract->number) }}" step="1" required>
                            @if($errors->has('number'))
                            <span class="help-block" role="alert">{{ $errors->first('number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.adminContract.fields.number_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('driver') ? 'has-error' : '' }}">
                            <label class="required" for="driver_id">{{ trans('cruds.adminContract.fields.driver')
                                }}</label>
                            <select class="form-control select2" name="driver_id" id="driver_id" required>
                                @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}" {{ (old('driver_id') ? old('driver_id') :
                                    $adminContract->driver->id ?? '') == $driver->id ? 'selected' : '' }}>{{
                                    $driver->name }} - NIF: {{ $driver->driver_vat }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('driver'))
                            <span class="help-block" role="alert">{{ $errors->first('driver') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.adminContract.fields.driver_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('signed_at') ? 'has-error' : '' }}">
                            <label for="signed_at">{{ trans('cruds.adminContract.fields.signed_at') }}</label>
                            <input class="form-control date" type="text" name="signed_at" id="signed_at"
                                value="{{ old('signed_at', $adminContract->signed_at) }}">
                            @if($errors->has('signed_at'))
                            <span class="help-block" role="alert">{{ $errors->first('signed_at') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.adminContract.fields.signed_at_helper') }}</span>
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