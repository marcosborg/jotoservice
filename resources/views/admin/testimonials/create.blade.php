@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.testimonial.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.testimonials.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                            <label for="message">{{ trans('cruds.testimonial.fields.message') }}</label>
                            <input class="form-control" type="text" name="message" id="message" value="{{ old('message', '') }}">
                            @if($errors->has('message'))
                                <span class="help-block" role="alert">{{ $errors->first('message') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.testimonial.fields.message_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">{{ trans('cruds.testimonial.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}">
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.testimonial.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('job_position') ? 'has-error' : '' }}">
                            <label for="job_position">{{ trans('cruds.testimonial.fields.job_position') }}</label>
                            <input class="form-control" type="text" name="job_position" id="job_position" value="{{ old('job_position', '') }}">
                            @if($errors->has('job_position'))
                                <span class="help-block" role="alert">{{ $errors->first('job_position') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.testimonial.fields.job_position_helper') }}</span>
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