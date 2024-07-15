@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.standCarForm.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.stand-car-forms.update", [$standCarForm->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.standCarForm.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $standCarForm->name) }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.standCarForm.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                            <label class="required" for="phone">{{ trans('cruds.standCarForm.fields.phone') }}</label>
                            <input class="form-control" type="text" name="phone" id="phone" value="{{ old('phone', $standCarForm->phone) }}" required>
                            @if($errors->has('phone'))
                                <span class="help-block" role="alert">{{ $errors->first('phone') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.standCarForm.fields.phone_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="required" for="email">{{ trans('cruds.standCarForm.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email', $standCarForm->email) }}" required>
                            @if($errors->has('email'))
                                <span class="help-block" role="alert">{{ $errors->first('email') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.standCarForm.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                            <label class="required" for="city">{{ trans('cruds.standCarForm.fields.city') }}</label>
                            <input class="form-control" type="text" name="city" id="city" value="{{ old('city', $standCarForm->city) }}" required>
                            @if($errors->has('city'))
                                <span class="help-block" role="alert">{{ $errors->first('city') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.standCarForm.fields.city_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('car') ? 'has-error' : '' }}">
                            <label class="required" for="car_id">{{ trans('cruds.standCarForm.fields.car') }}</label>
                            <select class="form-control select2" name="car_id" id="car_id" required>
                                @foreach($cars as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('car_id') ? old('car_id') : $standCarForm->car->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('car'))
                                <span class="help-block" role="alert">{{ $errors->first('car') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.standCarForm.fields.car_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                            <label class="required" for="message">{{ trans('cruds.standCarForm.fields.message') }}</label>
                            <textarea class="form-control" name="message" id="message" required>{{ old('message', $standCarForm->message) }}</textarea>
                            @if($errors->has('message'))
                                <span class="help-block" role="alert">{{ $errors->first('message') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.standCarForm.fields.message_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('rgpd') ? 'has-error' : '' }}">
                            <div>
                                <input type="checkbox" name="rgpd" id="rgpd" value="1" {{ $standCarForm->rgpd || old('rgpd', 0) === 1 ? 'checked' : '' }} required>
                                <label class="required" for="rgpd" style="font-weight: 400">{{ trans('cruds.standCarForm.fields.rgpd') }}</label>
                            </div>
                            @if($errors->has('rgpd'))
                                <span class="help-block" role="alert">{{ $errors->first('rgpd') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.standCarForm.fields.rgpd_helper') }}</span>
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