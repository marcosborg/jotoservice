@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.carModel.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.car-models.update", [$carModel->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.carModel.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $carModel->name) }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.carModel.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('brand') ? 'has-error' : '' }}">
                            <label class="required" for="brand_id">{{ trans('cruds.carModel.fields.brand') }}</label>
                            <select class="form-control select2" name="brand_id" id="brand_id" required>
                                @foreach($brands as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('brand_id') ? old('brand_id') : $carModel->brand->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('brand'))
                                <span class="help-block" role="alert">{{ $errors->first('brand') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.carModel.fields.brand_helper') }}</span>
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