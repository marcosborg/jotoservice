@extends('layouts.admin')
@section('content')
<div class="content">
    @can('vehicle_event_warning_time_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.vehicle-event-warning-times.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.vehicleEventWarningTime.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.vehicleEventWarningTime.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-VehicleEventWarningTime">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleEventWarningTime.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleEventWarningTime.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleEventWarningTime.fields.days') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vehicleEventWarningTimes as $key => $vehicleEventWarningTime)
                                    <tr data-entry-id="{{ $vehicleEventWarningTime->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $vehicleEventWarningTime->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vehicleEventWarningTime->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vehicleEventWarningTime->days ?? '' }}
                                        </td>
                                        <td>
                                            @can('vehicle_event_warning_time_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.vehicle-event-warning-times.show', $vehicleEventWarningTime->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('vehicle_event_warning_time_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.vehicle-event-warning-times.edit', $vehicleEventWarningTime->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('vehicle_event_warning_time_delete')
                                                <form action="{{ route('admin.vehicle-event-warning-times.destroy', $vehicleEventWarningTime->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('vehicle_event_warning_time_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.vehicle-event-warning-times.massDestroy') }}",
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
  let table = $('.datatable-VehicleEventWarningTime:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection