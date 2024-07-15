@extends('layouts.admin')
@section('content')
<div class="content">
    @can('home_info_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.home-infos.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.homeInfo.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.homeInfo.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-HomeInfo">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.homeInfo.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.homeInfo.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.homeInfo.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.homeInfo.fields.image') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.homeInfo.fields.button') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.homeInfo.fields.link') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($homeInfos as $key => $homeInfo)
                                    <tr data-entry-id="{{ $homeInfo->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $homeInfo->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $homeInfo->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $homeInfo->description ?? '' }}
                                        </td>
                                        <td>
                                            @if($homeInfo->image)
                                                <a href="{{ $homeInfo->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $homeInfo->image->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $homeInfo->button ?? '' }}
                                        </td>
                                        <td>
                                            {{ $homeInfo->link ?? '' }}
                                        </td>
                                        <td>
                                            @can('home_info_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.home-infos.show', $homeInfo->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('home_info_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.home-infos.edit', $homeInfo->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('home_info_delete')
                                                <form action="{{ route('admin.home-infos.destroy', $homeInfo->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('home_info_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.home-infos.massDestroy') }}",
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
  let table = $('.datatable-HomeInfo:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection