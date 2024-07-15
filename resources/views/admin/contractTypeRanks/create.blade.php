@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.contractTypeRank.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.contract-type-ranks.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('from') ? 'has-error' : '' }}">
                            <label for="from">{{ trans('cruds.contractTypeRank.fields.from') }}</label>
                            <input class="form-control" type="number" name="from" id="from" value="{{ old('from', '') }}" step="0.01">
                            @if($errors->has('from'))
                                <span class="help-block" role="alert">{{ $errors->first('from') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.contractTypeRank.fields.from_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('to') ? 'has-error' : '' }}">
                            <label for="to">{{ trans('cruds.contractTypeRank.fields.to') }}</label>
                            <input class="form-control" type="number" name="to" id="to" value="{{ old('to', '') }}" step="0.01">
                            @if($errors->has('to'))
                                <span class="help-block" role="alert">{{ $errors->first('to') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.contractTypeRank.fields.to_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('percent') ? 'has-error' : '' }}">
                            <label class="required" for="percent">{{ trans('cruds.contractTypeRank.fields.percent') }}</label>
                            <input class="form-control" type="number" name="percent" id="percent" value="{{ old('percent', '') }}" step="0.01" required>
                            @if($errors->has('percent'))
                                <span class="help-block" role="alert">{{ $errors->first('percent') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.contractTypeRank.fields.percent_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('contract_type') ? 'has-error' : '' }}">
                            <label class="required" for="contract_type_id">{{ trans('cruds.contractTypeRank.fields.contract_type') }}</label>
                            <select class="form-control select2" name="contract_type_id" id="contract_type_id" required>
                                @foreach($contract_types as $id => $entry)
                                    <option value="{{ $id }}" {{ old('contract_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('contract_type'))
                                <span class="help-block" role="alert">{{ $errors->first('contract_type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.contractTypeRank.fields.contract_type_helper') }}</span>
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