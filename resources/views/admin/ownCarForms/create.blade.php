@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.ownCarForm.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.own-car-forms.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.ownCarForm.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.ownCarForm.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                            <label class="required" for="phone">{{ trans('cruds.ownCarForm.fields.phone') }}</label>
                            <input class="form-control" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                            @if($errors->has('phone'))
                                <span class="help-block" role="alert">{{ $errors->first('phone') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.ownCarForm.fields.phone_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="required" for="email">{{ trans('cruds.ownCarForm.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" required>
                            @if($errors->has('email'))
                                <span class="help-block" role="alert">{{ $errors->first('email') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.ownCarForm.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                            <label for="city">{{ trans('cruds.ownCarForm.fields.city') }}</label>
                            <input class="form-control" type="text" name="city" id="city" value="{{ old('city', '') }}">
                            @if($errors->has('city'))
                                <span class="help-block" role="alert">{{ $errors->first('city') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.ownCarForm.fields.city_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('tvde') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="tvde" value="0">
                                <input type="checkbox" name="tvde" id="tvde" value="1" {{ old('tvde', 0) == 1 ? 'checked' : '' }}>
                                <label for="tvde" style="font-weight: 400">{{ trans('cruds.ownCarForm.fields.tvde') }}</label>
                            </div>
                            @if($errors->has('tvde'))
                                <span class="help-block" role="alert">{{ $errors->first('tvde') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.ownCarForm.fields.tvde_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('tvde_card') ? 'has-error' : '' }}">
                            <label for="tvde_card">{{ trans('cruds.ownCarForm.fields.tvde_card') }}</label>
                            <input class="form-control" type="text" name="tvde_card" id="tvde_card" value="{{ old('tvde_card', '') }}">
                            @if($errors->has('tvde_card'))
                                <span class="help-block" role="alert">{{ $errors->first('tvde_card') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.ownCarForm.fields.tvde_card_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                            <label for="message">{{ trans('cruds.ownCarForm.fields.message') }}</label>
                            <textarea class="form-control" name="message" id="message">{{ old('message') }}</textarea>
                            @if($errors->has('message'))
                                <span class="help-block" role="alert">{{ $errors->first('message') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.ownCarForm.fields.message_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('rgpd') ? 'has-error' : '' }}">
                            <div>
                                <input type="checkbox" name="rgpd" id="rgpd" value="1" required {{ old('rgpd', 0) == 1 ? 'checked' : '' }}>
                                <label class="required" for="rgpd" style="font-weight: 400">{{ trans('cruds.ownCarForm.fields.rgpd') }}</label>
                            </div>
                            @if($errors->has('rgpd'))
                                <span class="help-block" role="alert">{{ $errors->first('rgpd') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.ownCarForm.fields.rgpd_helper') }}</span>
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