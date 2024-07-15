@extends('layouts.admin')
@section('content')
<div class="content">
    @can('tvde_week_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.tvde-weeks.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.tvdeWeek.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.tvdeWeek.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-TvdeWeek">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.tvdeWeek.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.tvdeWeek.fields.tvde_month') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.tvdeWeek.fields.number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.tvdeWeek.fields.start_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.tvdeWeek.fields.end_date') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tvdeWeeks as $key => $tvdeWeek)
                                    <tr data-entry-id="{{ $tvdeWeek->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $tvdeWeek->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $tvdeWeek->tvde_month->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $tvdeWeek->number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $tvdeWeek->start_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $tvdeWeek->end_date ?? '' }}
                                        </td>
                                        <td>
                                            @can('tvde_week_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.tvde-weeks.show', $tvdeWeek->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('tvde_week_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.tvde-weeks.edit', $tvdeWeek->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('tvde_week_delete')
                                                <form action="{{ route('admin.tvde-weeks.destroy', $tvdeWeek->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('tvde_week_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tvde-weeks.massDestroy') }}",
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
  let table = $('.datatable-TvdeWeek:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection