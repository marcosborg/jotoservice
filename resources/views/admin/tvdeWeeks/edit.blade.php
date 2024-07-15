@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.tvdeWeek.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.tvde-weeks.update", [$tvdeWeek->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('tvde_month') ? 'has-error' : '' }}">
                            <label class="required" for="tvde_month_id">{{ trans('cruds.tvdeWeek.fields.tvde_month') }}</label>
                            <select class="form-control select2" name="tvde_month_id" id="tvde_month_id" required>
                                @foreach($tvde_months as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('tvde_month_id') ? old('tvde_month_id') : $tvdeWeek->tvde_month->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('tvde_month'))
                                <span class="help-block" role="alert">{{ $errors->first('tvde_month') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.tvdeWeek.fields.tvde_month_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('number') ? 'has-error' : '' }}">
                            <label class="required" for="number">{{ trans('cruds.tvdeWeek.fields.number') }}</label>
                            <input class="form-control" type="number" name="number" id="number" value="{{ old('number', $tvdeWeek->number) }}" step="1" required>
                            @if($errors->has('number'))
                                <span class="help-block" role="alert">{{ $errors->first('number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.tvdeWeek.fields.number_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                            <label class="required" for="start_date">{{ trans('cruds.tvdeWeek.fields.start_date') }}</label>
                            <input class="form-control date" type="text" name="start_date" id="start_date" value="{{ old('start_date', $tvdeWeek->start_date) }}" required>
                            @if($errors->has('start_date'))
                                <span class="help-block" role="alert">{{ $errors->first('start_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.tvdeWeek.fields.start_date_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                            <label class="required" for="end_date">{{ trans('cruds.tvdeWeek.fields.end_date') }}</label>
                            <input class="form-control date" type="text" name="end_date" id="end_date" value="{{ old('end_date', $tvdeWeek->end_date) }}" required>
                            @if($errors->has('end_date'))
                                <span class="help-block" role="alert">{{ $errors->first('end_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.tvdeWeek.fields.end_date_helper') }}</span>
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