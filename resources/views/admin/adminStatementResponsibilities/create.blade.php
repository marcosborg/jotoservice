@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.adminStatementResponsibility.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.admin-statement-responsibilities.store") }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('contract_number') ? 'has-error' : '' }}">
                            <label class="required" for="contract_number">{{
                                trans('cruds.adminStatementResponsibility.fields.contract_number') }}</label>
                            <input class="form-control" type="number" name="contract_number" id="contract_number"
                                value="{{ old('contract_number', '') }}" step="1" required>
                            @if($errors->has('contract_number'))
                            <span class="help-block" role="alert">{{ $errors->first('contract_number') }}</span>
                            @endif
                            <span class="help-block">{{
                                trans('cruds.adminStatementResponsibility.fields.contract_number_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('driver') ? 'has-error' : '' }}">
                            <label class="required" for="driver_id">{{
                                trans('cruds.adminStatementResponsibility.fields.driver') }}</label>
                            <select class="form-control select2" name="driver_id" id="driver_id" required>
                                <option selected disabled>{{ trans('global.pleaseSelect') }}</option>
                                @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}" {{ old('driver_id')==$driver->id ? 'selected' : ''
                                    }}>{{ $driver->name }} - NIF: {{ $driver->driver_vat }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('driver'))
                            <span class="help-block" role="alert">{{ $errors->first('driver') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.adminStatementResponsibility.fields.driver_helper')
                                }}</span>
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