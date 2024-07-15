@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.courierForm.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.courier-forms.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.courierForm.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.courierForm.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                            <label class="required" for="phone">{{ trans('cruds.courierForm.fields.phone') }}</label>
                            <input class="form-control" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                            @if($errors->has('phone'))
                                <span class="help-block" role="alert">{{ $errors->first('phone') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.courierForm.fields.phone_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">{{ trans('cruds.courierForm.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
                            @if($errors->has('email'))
                                <span class="help-block" role="alert">{{ $errors->first('email') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.courierForm.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                            <label for="city">{{ trans('cruds.courierForm.fields.city') }}</label>
                            <input class="form-control" type="text" name="city" id="city" value="{{ old('city', '') }}">
                            @if($errors->has('city'))
                                <span class="help-block" role="alert">{{ $errors->first('city') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.courierForm.fields.city_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('courier') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="courier" value="0">
                                <input type="checkbox" name="courier" id="courier" value="1" {{ old('courier', 0) == 1 ? 'checked' : '' }}>
                                <label for="courier" style="font-weight: 400">{{ trans('cruds.courierForm.fields.courier') }}</label>
                            </div>
                            @if($errors->has('courier'))
                                <span class="help-block" role="alert">{{ $errors->first('courier') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.courierForm.fields.courier_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('account') ? 'has-error' : '' }}">
                            <label for="account">{{ trans('cruds.courierForm.fields.account') }}</label>
                            <input class="form-control" type="text" name="account" id="account" value="{{ old('account', '') }}">
                            @if($errors->has('account'))
                                <span class="help-block" role="alert">{{ $errors->first('account') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.courierForm.fields.account_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('rgpd') ? 'has-error' : '' }}">
                            <div>
                                <input type="checkbox" name="rgpd" id="rgpd" value="1" required {{ old('rgpd', 0) == 1 ? 'checked' : '' }}>
                                <label class="required" for="rgpd" style="font-weight: 400">{{ trans('cruds.courierForm.fields.rgpd') }}</label>
                            </div>
                            @if($errors->has('rgpd'))
                                <span class="help-block" role="alert">{{ $errors->first('rgpd') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.courierForm.fields.rgpd_helper') }}</span>
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