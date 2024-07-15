@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.transferForm.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.transfer-forms.update", [$transferForm->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.transferForm.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $transferForm->name) }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.transferForm.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                            <label class="required" for="phone">{{ trans('cruds.transferForm.fields.phone') }}</label>
                            <input class="form-control" type="text" name="phone" id="phone" value="{{ old('phone', $transferForm->phone) }}" required>
                            @if($errors->has('phone'))
                                <span class="help-block" role="alert">{{ $errors->first('phone') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.transferForm.fields.phone_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">{{ trans('cruds.transferForm.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email', $transferForm->email) }}">
                            @if($errors->has('email'))
                                <span class="help-block" role="alert">{{ $errors->first('email') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.transferForm.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                            <label for="city">{{ trans('cruds.transferForm.fields.city') }}</label>
                            <input class="form-control" type="text" name="city" id="city" value="{{ old('city', $transferForm->city) }}">
                            @if($errors->has('city'))
                                <span class="help-block" role="alert">{{ $errors->first('city') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.transferForm.fields.city_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('rgpd') ? 'has-error' : '' }}">
                            <div>
                                <input type="checkbox" name="rgpd" id="rgpd" value="1" {{ $transferForm->rgpd || old('rgpd', 0) === 1 ? 'checked' : '' }} required>
                                <label class="required" for="rgpd" style="font-weight: 400">{{ trans('cruds.transferForm.fields.rgpd') }}</label>
                            </div>
                            @if($errors->has('rgpd'))
                                <span class="help-block" role="alert">{{ $errors->first('rgpd') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.transferForm.fields.rgpd_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('transfer_tour') ? 'has-error' : '' }}">
                            <label class="required" for="transfer_tour_id">{{ trans('cruds.transferForm.fields.transfer_tour') }}</label>
                            <select class="form-control select2" name="transfer_tour_id" id="transfer_tour_id" required>
                                @foreach($transfer_tours as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('transfer_tour_id') ? old('transfer_tour_id') : $transferForm->transfer_tour->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('transfer_tour'))
                                <span class="help-block" role="alert">{{ $errors->first('transfer_tour') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.transferForm.fields.transfer_tour_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                            <label for="message">{{ trans('cruds.transferForm.fields.message') }}</label>
                            <textarea class="form-control" name="message" id="message">{{ old('message', $transferForm->message) }}</textarea>
                            @if($errors->has('message'))
                                <span class="help-block" role="alert">{{ $errors->first('message') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.transferForm.fields.message_helper') }}</span>
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