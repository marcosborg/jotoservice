@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.carRentalContactRequest.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.car-rental-contact-requests.update", [$carRentalContactRequest->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.carRentalContactRequest.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $carRentalContactRequest->name) }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.carRentalContactRequest.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                            <label class="required" for="phone">{{ trans('cruds.carRentalContactRequest.fields.phone') }}</label>
                            <input class="form-control" type="text" name="phone" id="phone" value="{{ old('phone', $carRentalContactRequest->phone) }}" required>
                            @if($errors->has('phone'))
                                <span class="help-block" role="alert">{{ $errors->first('phone') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.carRentalContactRequest.fields.phone_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="required" for="email">{{ trans('cruds.carRentalContactRequest.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email', $carRentalContactRequest->email) }}" required>
                            @if($errors->has('email'))
                                <span class="help-block" role="alert">{{ $errors->first('email') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.carRentalContactRequest.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                            <label class="required" for="city">{{ trans('cruds.carRentalContactRequest.fields.city') }}</label>
                            <input class="form-control" type="text" name="city" id="city" value="{{ old('city', $carRentalContactRequest->city) }}" required>
                            @if($errors->has('city'))
                                <span class="help-block" role="alert">{{ $errors->first('city') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.carRentalContactRequest.fields.city_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('tvde') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="tvde" value="0">
                                <input type="checkbox" name="tvde" id="tvde" value="1" {{ $carRentalContactRequest->tvde || old('tvde', 0) === 1 ? 'checked' : '' }}>
                                <label for="tvde" style="font-weight: 400">{{ trans('cruds.carRentalContactRequest.fields.tvde') }}</label>
                            </div>
                            @if($errors->has('tvde'))
                                <span class="help-block" role="alert">{{ $errors->first('tvde') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.carRentalContactRequest.fields.tvde_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('tvde_card') ? 'has-error' : '' }}">
                            <label for="tvde_card">{{ trans('cruds.carRentalContactRequest.fields.tvde_card') }}</label>
                            <input class="form-control" type="text" name="tvde_card" id="tvde_card" value="{{ old('tvde_card', $carRentalContactRequest->tvde_card) }}">
                            @if($errors->has('tvde_card'))
                                <span class="help-block" role="alert">{{ $errors->first('tvde_card') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.carRentalContactRequest.fields.tvde_card_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('car') ? 'has-error' : '' }}">
                            <label class="required" for="car_id">{{ trans('cruds.carRentalContactRequest.fields.car') }}</label>
                            <select class="form-control select2" name="car_id" id="car_id" required>
                                @foreach($cars as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('car_id') ? old('car_id') : $carRentalContactRequest->car->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('car'))
                                <span class="help-block" role="alert">{{ $errors->first('car') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.carRentalContactRequest.fields.car_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                            <label class="required" for="message">{{ trans('cruds.carRentalContactRequest.fields.message') }}</label>
                            <textarea class="form-control" name="message" id="message" required>{{ old('message', $carRentalContactRequest->message) }}</textarea>
                            @if($errors->has('message'))
                                <span class="help-block" role="alert">{{ $errors->first('message') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.carRentalContactRequest.fields.message_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('rgpd') ? 'has-error' : '' }}">
                            <div>
                                <input type="checkbox" name="rgpd" id="rgpd" value="1" {{ $carRentalContactRequest->rgpd || old('rgpd', 0) === 1 ? 'checked' : '' }} required>
                                <label class="required" for="rgpd" style="font-weight: 400">{{ trans('cruds.carRentalContactRequest.fields.rgpd') }}</label>
                            </div>
                            @if($errors->has('rgpd'))
                                <span class="help-block" role="alert">{{ $errors->first('rgpd') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.carRentalContactRequest.fields.rgpd_helper') }}</span>
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