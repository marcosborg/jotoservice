@extends('layouts.admin')
@section('content')
<div class="content">
    @can('document_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.documents.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.document.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.document.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Document">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.document.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.document.fields.driver') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.driver.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.document.fields.citizen_card') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.document.fields.tvde_driver_certificate') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.document.fields.criminal_record') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.document.fields.profile_picture') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.document.fields.driving_license') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.document.fields.iban') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.document.fields.address') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.document.fields.notes') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documents as $key => $document)
                                    <tr data-entry-id="{{ $document->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $document->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $document->driver->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $document->driver->email ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($document->citizen_card as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($document->tvde_driver_certificate as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($document->criminal_record as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if($document->profile_picture)
                                                <a href="{{ $document->profile_picture->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $document->profile_picture->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @foreach($document->driving_license as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($document->iban as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($document->address as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $document->notes ?? '' }}
                                        </td>
                                        <td>
                                            @can('document_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.documents.show', $document->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('document_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.documents.edit', $document->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('document_delete')
                                                <form action="{{ route('admin.documents.destroy', $document->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('document_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.documents.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Document:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection