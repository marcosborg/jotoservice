@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.contractVat.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.contract-vats.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.contractVat.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.contractVat.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('percent') ? 'has-error' : '' }}">
                            <label class="required" for="percent">{{ trans('cruds.contractVat.fields.percent') }}</label>
                            <input class="form-control" type="number" name="percent" id="percent" value="{{ old('percent', '') }}" step="0.01" required>
                            @if($errors->has('percent'))
                                <span class="help-block" role="alert">{{ $errors->first('percent') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.contractVat.fields.percent_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('tips') ? 'has-error' : '' }}">
                            <label class="required" for="tips">{{ trans('cruds.contractVat.fields.tips') }}</label>
                            <input class="form-control" type="number" name="tips" id="tips" value="{{ old('tips', '') }}" step="0.01" required>
                            @if($errors->has('tips'))
                                <span class="help-block" role="alert">{{ $errors->first('tips') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.contractVat.fields.tips_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('contract_type') ? 'has-error' : '' }}">
                            <label class="required" for="contract_type_id">{{ trans('cruds.contractVat.fields.contract_type') }}</label>
                            <select class="form-control select2" name="contract_type_id" id="contract_type_id" required>
                                @foreach($contract_types as $id => $entry)
                                    <option value="{{ $id }}" {{ old('contract_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('contract_type'))
                                <span class="help-block" role="alert">{{ $errors->first('contract_type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.contractVat.fields.contract_type_helper') }}</span>
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