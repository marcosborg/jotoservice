@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.tvdeMonth.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.tvde-months.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('year') ? 'has-error' : '' }}">
                            <label class="required" for="year_id">{{ trans('cruds.tvdeMonth.fields.year') }}</label>
                            <select class="form-control select2" name="year_id" id="year_id" required>
                                @foreach($years as $id => $entry)
                                    <option value="{{ $id }}" {{ old('year_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('year'))
                                <span class="help-block" role="alert">{{ $errors->first('year') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.tvdeMonth.fields.year_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.tvdeMonth.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.tvdeMonth.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('number') ? 'has-error' : '' }}">
                            <label class="required" for="number">{{ trans('cruds.tvdeMonth.fields.number') }}</label>
                            <input class="form-control" type="number" name="number" id="number" value="{{ old('number', '') }}" step="1" required>
                            @if($errors->has('number'))
                                <span class="help-block" role="alert">{{ $errors->first('number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.tvdeMonth.fields.number_helper') }}</span>
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