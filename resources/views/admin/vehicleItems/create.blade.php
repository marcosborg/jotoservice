@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.vehicleItem.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.vehicle-items.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('driver') ? 'has-error' : '' }}">
                            <label for="driver_id">{{ trans('cruds.vehicleItem.fields.driver') }}</label>
                            <select class="form-control select2" name="driver_id" id="driver_id">
                                @foreach($drivers as $id => $entry)
                                    <option value="{{ $id }}" {{ old('driver_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('driver'))
                                <span class="help-block" role="alert">{{ $errors->first('driver') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleItem.fields.driver_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('vehicle_brand') ? 'has-error' : '' }}">
                            <label class="required" for="vehicle_brand_id">{{ trans('cruds.vehicleItem.fields.vehicle_brand') }}</label>
                            <select class="form-control select2" name="vehicle_brand_id" id="vehicle_brand_id" required>
                                @foreach($vehicle_brands as $id => $entry)
                                    <option value="{{ $id }}" {{ old('vehicle_brand_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('vehicle_brand'))
                                <span class="help-block" role="alert">{{ $errors->first('vehicle_brand') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleItem.fields.vehicle_brand_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('vehicle_model') ? 'has-error' : '' }}">
                            <label class="required" for="vehicle_model_id">{{ trans('cruds.vehicleItem.fields.vehicle_model') }}</label>
                            <select class="form-control select2" name="vehicle_model_id" id="vehicle_model_id" required>
                                @foreach($vehicle_models as $id => $entry)
                                    <option value="{{ $id }}" {{ old('vehicle_model_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('vehicle_model'))
                                <span class="help-block" role="alert">{{ $errors->first('vehicle_model') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleItem.fields.vehicle_model_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('year') ? 'has-error' : '' }}">
                            <label class="required" for="year">{{ trans('cruds.vehicleItem.fields.year') }}</label>
                            <input class="form-control" type="text" name="year" id="year" value="{{ old('year', '') }}" required>
                            @if($errors->has('year'))
                                <span class="help-block" role="alert">{{ $errors->first('year') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleItem.fields.year_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('license_plate') ? 'has-error' : '' }}">
                            <label class="required" for="license_plate">{{ trans('cruds.vehicleItem.fields.license_plate') }}</label>
                            <input class="form-control" type="text" name="license_plate" id="license_plate" value="{{ old('license_plate', '') }}" required>
                            @if($errors->has('license_plate'))
                                <span class="help-block" role="alert">{{ $errors->first('license_plate') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleItem.fields.license_plate_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('documents') ? 'has-error' : '' }}">
                            <label for="documents">{{ trans('cruds.vehicleItem.fields.documents') }}</label>
                            <div class="needsclick dropzone" id="documents-dropzone">
                            </div>
                            @if($errors->has('documents'))
                                <span class="help-block" role="alert">{{ $errors->first('documents') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleItem.fields.documents_helper') }}</span>
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
    var uploadedDocumentsMap = {}
Dropzone.options.documentsDropzone = {
    url: '{{ route('admin.vehicle-items.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="documents[]" value="' + response.name + '">')
      uploadedDocumentsMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDocumentsMap[file.name]
      }
      $('form').find('input[name="documents[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($vehicleItem) && $vehicleItem->documents)
          var files =
            {!! json_encode($vehicleItem->documents) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="documents[]" value="' + file.file_name + '">')
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