@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.standCar.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.stand-cars.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('brand') ? 'has-error' : '' }}">
                            <label class="required" for="brand_id">{{ trans('cruds.standCar.fields.brand') }}</label>
                            <select class="form-control select2" name="brand_id" id="brand_id" required>
                                @foreach($brands as $id => $entry)
                                    <option value="{{ $id }}" {{ old('brand_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('brand'))
                                <span class="help-block" role="alert">{{ $errors->first('brand') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.standCar.fields.brand_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('car_model') ? 'has-error' : '' }}">
                            <label class="required" for="car_model_id">{{ trans('cruds.standCar.fields.car_model') }}</label>
                            <select class="form-control select2" name="car_model_id" id="car_model_id" required>
                                @foreach($car_models as $id => $entry)
                                    <option value="{{ $id }}" {{ old('car_model_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('car_model'))
                                <span class="help-block" role="alert">{{ $errors->first('car_model') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.standCar.fields.car_model_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('fuel') ? 'has-error' : '' }}">
                            <label class="required" for="fuel_id">{{ trans('cruds.standCar.fields.fuel') }}</label>
                            <select class="form-control select2" name="fuel_id" id="fuel_id" required>
                                @foreach($fuels as $id => $entry)
                                    <option value="{{ $id }}" {{ old('fuel_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('fuel'))
                                <span class="help-block" role="alert">{{ $errors->first('fuel') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.standCar.fields.fuel_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('transmision') ? 'has-error' : '' }}">
                            <label class="required">{{ trans('cruds.standCar.fields.transmision') }}</label>
                            @foreach(App\Models\StandCar::TRANSMISION_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="transmision_{{ $key }}" name="transmision" value="{{ $key }}" {{ old('transmision', 'Manual') === (string) $key ? 'checked' : '' }} required>
                                    <label for="transmision_{{ $key }}" style="font-weight: 400">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('transmision'))
                                <span class="help-block" role="alert">{{ $errors->first('transmision') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.standCar.fields.transmision_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('cylinder_capacity') ? 'has-error' : '' }}">
                            <label for="cylinder_capacity">{{ trans('cruds.standCar.fields.cylinder_capacity') }}</label>
                            <input class="form-control" type="number" name="cylinder_capacity" id="cylinder_capacity" value="{{ old('cylinder_capacity', '') }}" step="0.01">
                            @if($errors->has('cylinder_capacity'))
                                <span class="help-block" role="alert">{{ $errors->first('cylinder_capacity') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.standCar.fields.cylinder_capacity_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('battery_capacity') ? 'has-error' : '' }}">
                            <label for="battery_capacity">{{ trans('cruds.standCar.fields.battery_capacity') }}</label>
                            <input class="form-control" type="number" name="battery_capacity" id="battery_capacity" value="{{ old('battery_capacity', '') }}" step="1">
                            @if($errors->has('battery_capacity'))
                                <span class="help-block" role="alert">{{ $errors->first('battery_capacity') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.standCar.fields.battery_capacity_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('year') ? 'has-error' : '' }}">
                            <label class="required" for="year">{{ trans('cruds.standCar.fields.year') }}</label>
                            <input class="form-control" type="number" name="year" id="year" value="{{ old('year', '') }}" step="1" required>
                            @if($errors->has('year'))
                                <span class="help-block" role="alert">{{ $errors->first('year') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.standCar.fields.year_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('month') ? 'has-error' : '' }}">
                            <label class="required" for="month_id">{{ trans('cruds.standCar.fields.month') }}</label>
                            <select class="form-control select2" name="month_id" id="month_id" required>
                                @foreach($months as $id => $entry)
                                    <option value="{{ $id }}" {{ old('month_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('month'))
                                <span class="help-block" role="alert">{{ $errors->first('month') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.standCar.fields.month_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('kilometers') ? 'has-error' : '' }}">
                            <label class="required" for="kilometers">{{ trans('cruds.standCar.fields.kilometers') }}</label>
                            <input class="form-control" type="text" name="kilometers" id="kilometers" value="{{ old('kilometers', '') }}" required>
                            @if($errors->has('kilometers'))
                                <span class="help-block" role="alert">{{ $errors->first('kilometers') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.standCar.fields.kilometers_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('power') ? 'has-error' : '' }}">
                            <label class="required" for="power">{{ trans('cruds.standCar.fields.power') }}</label>
                            <input class="form-control" type="number" name="power" id="power" value="{{ old('power', '') }}" step="1" required>
                            @if($errors->has('power'))
                                <span class="help-block" role="alert">{{ $errors->first('power') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.standCar.fields.power_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('origin') ? 'has-error' : '' }}">
                            <label class="required" for="origin_id">{{ trans('cruds.standCar.fields.origin') }}</label>
                            <select class="form-control select2" name="origin_id" id="origin_id" required>
                                @foreach($origins as $id => $entry)
                                    <option value="{{ $id }}" {{ old('origin_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('origin'))
                                <span class="help-block" role="alert">{{ $errors->first('origin') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.standCar.fields.origin_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('distance') ? 'has-error' : '' }}">
                            <label class="required" for="distance">{{ trans('cruds.standCar.fields.distance') }}</label>
                            <input class="form-control" type="text" name="distance" id="distance" value="{{ old('distance', '') }}" required>
                            @if($errors->has('distance'))
                                <span class="help-block" role="alert">{{ $errors->first('distance') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.standCar.fields.distance_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                            <label for="price">{{ trans('cruds.standCar.fields.price') }}</label>
                            <input class="form-control" type="number" name="price" id="price" value="{{ old('price', '0.00') }}" step="0.01">
                            @if($errors->has('price'))
                                <span class="help-block" role="alert">{{ $errors->first('price') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.standCar.fields.price_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label class="required" for="status_id">{{ trans('cruds.standCar.fields.status') }}</label>
                            <select class="form-control select2" name="status_id" id="status_id" required>
                                @foreach($statuses as $id => $entry)
                                    <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <span class="help-block" role="alert">{{ $errors->first('status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.standCar.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('images') ? 'has-error' : '' }}">
                            <label for="images">{{ trans('cruds.standCar.fields.images') }}</label>
                            <div class="needsclick dropzone" id="images-dropzone">
                            </div>
                            @if($errors->has('images'))
                                <span class="help-block" role="alert">{{ $errors->first('images') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.standCar.fields.images_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedImagesMap = {}
Dropzone.options.imagesDropzone = {
    url: '{{ route('admin.stand-cars.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
      uploadedImagesMap[file.name] = response.name
    },
    removedfile: function (file) {

      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedImagesMap[file.name]
      }
      $('form').find('input[name="images[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($standCar) && $standCar->images)
      var files = {!! json_encode($standCar->images) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="images[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}

</script>
@endsection