@extends('layouts.admin')
@section('content')
<div class="content">

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          {{ trans('global.edit') }} {{ trans('cruds.consulting.title_singular') }}
        </div>
        <div class="panel-body">
          <form method="POST" action="{{ route("admin.consultings.update", [$consulting->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
              <label class="required" for="title">{{ trans('cruds.consulting.fields.title') }}</label>
              <input class="form-control" type="text" name="title" id="title"
                value="{{ old('title', $consulting->title) }}" required>
              @if($errors->has('title'))
              <span class="help-block" role="alert">{{ $errors->first('title') }}</span>
              @endif
              <span class="help-block">{{ trans('cruds.consulting.fields.title_helper') }}</span>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
              <label for="description">{{ trans('cruds.consulting.fields.description') }}</label>
              <input class="form-control" type="text" name="description" id="description"
                value="{{ old('description', $consulting->description) }}">
              @if($errors->has('description'))
              <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
              @endif
              <span class="help-block">{{ trans('cruds.consulting.fields.description_helper') }}</span>
            </div>
            <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
              <label for="image">{{ trans('cruds.consulting.fields.image') }}</label>
              <div class="needsclick dropzone" id="image-dropzone">
              </div>
              @if($errors->has('image'))
              <span class="help-block" role="alert">{{ $errors->first('image') }}</span>
              @endif
              <span class="help-block">{{ trans('cruds.consulting.fields.image_helper') }}</span>
            </div>
            <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
              <label for="text">{{ trans('cruds.consulting.fields.text') }}</label>
              <textarea class="form-control ckeditor" name="text"
                id="text">{!! old('text', $consulting->text) !!}</textarea>
              @if($errors->has('text'))
              <span class="help-block" role="alert">{{ $errors->first('text') }}</span>
              @endif
              <span class="help-block">{{ trans('cruds.consulting.fields.text_helper') }}</span>
            </div>
            <div class="form-group">
              <button class="btn btn-danger" type="submit">
                {{ trans('global.save') }}
              </button>
            </div>
            @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
            @endif
          </form>
        </div>
      </div>



    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  Dropzone.options.imageDropzone = {
    url: '{{ route('admin.consultings.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
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
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($consulting) && $consulting->image)
      var file = {!! json_encode($consulting->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
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
  $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.consultings.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $consulting->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection