@extends('layouts.admin')
@section('content')
<div class="content">
    @can('tvde_month_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.tvde-months.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.tvdeMonth.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.tvdeMonth.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-TvdeMonth">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.tvdeMonth.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.tvdeMonth.fields.year') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.tvdeMonth.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.tvdeMonth.fields.number') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tvdeMonths as $key => $tvdeMonth)
                                    <tr data-entry-id="{{ $tvdeMonth->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $tvdeMonth->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $tvdeMonth->year->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $tvdeMonth->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $tvdeMonth->number ?? '' }}
                                        </td>
                                        <td>
                                            @can('tvde_month_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.tvde-months.show', $tvdeMonth->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('tvde_month_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.tvde-months.edit', $tvdeMonth->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('tvde_month_delete')
                                                <form action="{{ route('admin.tvde-months.destroy', $tvdeMonth->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('tvde_month_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tvde-months.massDestroy') }}",
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
  let table = $('.datatable-TvdeMonth:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection