@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.activity.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.activities.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="title">{{ trans('cruds.activity.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}">
                            @if($errors->has('title'))
                                <span class="help-block" role="alert">{{ $errors->first('title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.activity.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.activity.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', '') }}">
                            @if($errors->has('description'))
                                <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.activity.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('button') ? 'has-error' : '' }}">
                            <label for="button">{{ trans('cruds.activity.fields.button') }}</label>
                            <input class="form-control" type="text" name="button" id="button" value="{{ old('button', '') }}">
                            @if($errors->has('button'))
                                <span class="help-block" role="alert">{{ $errors->first('button') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.activity.fields.button_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('link') ? 'has-error' : '' }}">
                            <label for="link">{{ trans('cruds.activity.fields.link') }}</label>
                            <input class="form-control" type="text" name="link" id="link" value="{{ old('link', '') }}">
                            @if($errors->has('link'))
                                <span class="help-block" role="alert">{{ $errors->first('link') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.activity.fields.link_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('icon') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.activity.fields.icon') }}</label>
                            <select class="form-control" name="icon" id="icon">
                                <option value disabled {{ old('icon', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Activity::ICON_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('icon', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('icon'))
                                <span class="help-block" role="alert">{{ $errors->first('icon') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.activity.fields.icon_helper') }}</span>
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