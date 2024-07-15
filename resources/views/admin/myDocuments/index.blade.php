@extends('layouts.admin')
@section('content')
<div class="content">

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          {{ trans('cruds.myDocument.title') }}
        </div>
        <div class="panel-body">
          <form method="POST" action="{{ route("admin.my-documents.update", [$document->id]) }}"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="driver_id" value="{{ $document->driver_id }}">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group {{ $errors->has('citizen_card') ? 'has-error' : '' }}">
                  <label for="citizen_card">{{ trans('cruds.document.fields.citizen_card') }}</label>
                  <div class="needsclick dropzone" id="citizen_card-dropzone">
                  </div>
                  @if($errors->has('citizen_card'))
                  <span class="help-block" role="alert">{{ $errors->first('citizen_card') }}</span>
                  @endif
                  <span class="help-block">{{ trans('cruds.document.fields.citizen_card_helper') }}</span>
                </div>
              </div>
              <div class="col-md-6">
                <label></label>
                <div class="panel panel-default">
                  <div class="panel-body">
                    <div class="list-group">
                      @foreach ($document->citizen_card as $key => $citizen_card)
                      <a href="{{ $citizen_card->original_url }}" target="_new" class="list-group-item">Ver
                        documento {{ $key + 1 }} - Cartão de cidadão</a>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group {{ $errors->has('tvde_driver_certificate') ? 'has-error' : '' }}">
                  <label for="tvde_driver_certificate">{{ trans('cruds.document.fields.tvde_driver_certificate')
                    }}</label>
                  <div class="needsclick dropzone" id="tvde_driver_certificate-dropzone">
                  </div>
                  @if($errors->has('tvde_driver_certificate'))
                  <span class="help-block" role="alert">{{ $errors->first('tvde_driver_certificate') }}</span>
                  @endif
                  <span class="help-block">{{ trans('cruds.document.fields.tvde_driver_certificate_helper') }}</span>
                </div>
              </div>
              <div class="col-md-6">
                <label></label>
                <div class="panel panel-default">
                  <div class="panel-body">
                    <div class="list-group">
                      @foreach ($document->tvde_driver_certificate as $key => $citizen_card)
                      <a href="{{ $citizen_card->original_url }}" target="_new" class="list-group-item">Ver
                        documento {{ $key + 1 }} - Certificado de motorista TVDE</a>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group {{ $errors->has('criminal_record') ? 'has-error' : '' }}">
                  <label for="criminal_record">{{ trans('cruds.document.fields.criminal_record') }}</label>
                  <div class="needsclick dropzone" id="criminal_record-dropzone">
                  </div>
                  @if($errors->has('criminal_record'))
                  <span class="help-block" role="alert">{{ $errors->first('criminal_record') }}</span>
                  @endif
                  <span class="help-block">{{ trans('cruds.document.fields.criminal_record_helper') }}</span>
                </div>
              </div>
              <div class="col-md-6">
                <label></label>
                <div class="panel panel-default">
                  <div class="panel-body">
                    <div class="list-group">
                      @foreach ($document->criminal_record as $key => $citizen_card)
                      <a href="{{ $citizen_card->original_url }}" target="_new" class="list-group-item">Ver
                        documento {{ $key + 1 }} - Certificado de registo criminal</a>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group {{ $errors->has('profile_picture') ? 'has-error' : '' }}">
                  <label for="profile_picture">{{ trans('cruds.document.fields.profile_picture') }}</label>
                  <div class="needsclick dropzone" id="profile_picture-dropzone">
                  </div>
                  @if($errors->has('profile_picture'))
                  <span class="help-block" role="alert">{{ $errors->first('profile_picture') }}</span>
                  @endif
                  <span class="help-block">{{ trans('cruds.document.fields.profile_picture_helper') }}</span>
                </div>
              </div>
              <div class="col-md-6">

              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group {{ $errors->has('driving_license') ? 'has-error' : '' }}">
                  <label for="driving_license">{{ trans('cruds.document.fields.driving_license') }}</label>
                  <div class="needsclick dropzone" id="driving_license-dropzone">
                  </div>
                  @if($errors->has('driving_license'))
                  <span class="help-block" role="alert">{{ $errors->first('driving_license') }}</span>
                  @endif
                  <span class="help-block">{{ trans('cruds.document.fields.driving_license_helper') }}</span>
                </div>
              </div>
              <div class="col-md-6">
                <label></label>
                <div class="panel panel-default">
                  <div class="panel-body">
                    <div class="list-group">
                      @foreach ($document->driving_license as $key => $citizen_card)
                      <a href="{{ $citizen_card->original_url }}" target="_new" class="list-group-item">Ver
                        documento {{ $key + 1 }} - Carta de condução</a>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group {{ $errors->has('iban') ? 'has-error' : '' }}">
                  <label for="iban">{{ trans('cruds.document.fields.iban') }}</label>
                  <div class="needsclick dropzone" id="iban-dropzone">
                  </div>
                  @if($errors->has('iban'))
                  <span class="help-block" role="alert">{{ $errors->first('iban') }}</span>
                  @endif
                  <span class="help-block">{{ trans('cruds.document.fields.iban_helper') }}</span>
                </div>
              </div>
              <div class="col-md-6">
                <label></label>
                <div class="panel panel-default">
                  <div class="panel-body">
                    <div class="list-group">
                      @foreach ($document->iban as $key => $citizen_card)
                      <a href="{{ $citizen_card->original_url }}" target="_new" class="list-group-item">Ver
                        documento {{ $key + 1 }} - Comprovativo de IBAN</a>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                  <label for="address">{{ trans('cruds.document.fields.address') }}</label>
                  <div class="needsclick dropzone" id="address-dropzone">
                  </div>
                  @if($errors->has('address'))
                  <span class="help-block" role="alert">{{ $errors->first('address') }}</span>
                  @endif
                  <span class="help-block">{{ trans('cruds.document.fields.address_helper') }}</span>
                </div>
              </div>
              <div class="col-md-6">
                <label></label>
                <div class="panel panel-default">
                  <div class="panel-body">
                    <div class="list-group">
                      @foreach ($document->address as $key => $citizen_card)
                      <a href="{{ $citizen_card->original_url }}" target="_new" class="list-group-item">Ver
                        documento {{ $key + 1 }} - Comprovativo de morada</a>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                  </button>
                </div>
              </div>
              <div class="col-md-6">

              </div>
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
  var uploadedCitizenCardMap = {}
Dropzone.options.citizenCardDropzone = {
    url: '{{ route('admin.my-documents.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: false,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="citizen_card[]" value="' + response.name + '">')
      uploadedCitizenCardMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedCitizenCardMap[file.name]
      }
      $('form').find('input[name="citizen_card[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($document) && $document->citizen_card)
          var files =
            {!! json_encode($document->citizen_card) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="citizen_card[]" value="' + file.file_name + '">')
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
<script>
  var uploadedTvdeDriverCertificateMap = {}
Dropzone.options.tvdeDriverCertificateDropzone = {
    url: '{{ route('admin.my-documents.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: false,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="tvde_driver_certificate[]" value="' + response.name + '">')
      uploadedTvdeDriverCertificateMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedTvdeDriverCertificateMap[file.name]
      }
      $('form').find('input[name="tvde_driver_certificate[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($document) && $document->tvde_driver_certificate)
          var files =
            {!! json_encode($document->tvde_driver_certificate) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="tvde_driver_certificate[]" value="' + file.file_name + '">')
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
<script>
  var uploadedCriminalRecordMap = {}
Dropzone.options.criminalRecordDropzone = {
    url: '{{ route('admin.my-documents.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: false,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="criminal_record[]" value="' + response.name + '">')
      uploadedCriminalRecordMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedCriminalRecordMap[file.name]
      }
      $('form').find('input[name="criminal_record[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($document) && $document->criminal_record)
          var files =
            {!! json_encode($document->criminal_record) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="criminal_record[]" value="' + file.file_name + '">')
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
<script>
  Dropzone.options.profilePictureDropzone = {
    url: '{{ route('admin.my-documents.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: false,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="profile_picture"]').remove()
      $('form').append('<input type="hidden" name="profile_picture" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="profile_picture"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($document) && $document->profile_picture)
      var file = {!! json_encode($document->profile_picture) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="profile_picture" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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
<script>
  var uploadedDrivingLicenseMap = {}
Dropzone.options.drivingLicenseDropzone = {
    url: '{{ route('admin.my-documents.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: false,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="driving_license[]" value="' + response.name + '">')
      uploadedDrivingLicenseMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDrivingLicenseMap[file.name]
      }
      $('form').find('input[name="driving_license[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($document) && $document->driving_license)
          var files =
            {!! json_encode($document->driving_license) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="driving_license[]" value="' + file.file_name + '">')
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
<script>
  var uploadedIbanMap = {}
Dropzone.options.ibanDropzone = {
    url: '{{ route('admin.documents.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: false,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="iban[]" value="' + response.name + '">')
      uploadedIbanMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedIbanMap[file.name]
      }
      $('form').find('input[name="iban[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($document) && $document->iban)
          var files =
            {!! json_encode($document->iban) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="iban[]" value="' + file.file_name + '">')
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
<script>
  var uploadedAddressMap = {}
Dropzone.options.addressDropzone = {
    url: '{{ route('admin.documents.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: false,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="address[]" value="' + response.name + '">')
      uploadedAddressMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedAddressMap[file.name]
      }
      $('form').find('input[name="address[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($document) && $document->address)
          var files =
            {!! json_encode($document->address) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="address[]" value="' + file.file_name + '">')
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