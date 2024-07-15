@extends('layouts.admin')
@section('content')
<div class="content">
    @can('vehicle_event_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.vehicle-events.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.vehicleEvent.title_singular') }}
            </a>
        </div>
    </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.vehicleEvent.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-VehicleEvent">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleEvent.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleEvent.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleEvent.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleEvent.fields.vehicle_event_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleEvent.fields.vehicle_event_warning_time') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleEventWarningTime.fields.days') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleEvent.fields.date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleEvent.fields.vehicle_item') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleEvent.fields.sent') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vehicleEvents as $key => $vehicleEvent)
                                <tr data-entry-id="{{ $vehicleEvent->id }}">
                                    <td>

                                    </td>
                                    <td>
                                        {{ $vehicleEvent->id ?? '' }}
                                    </td>
                                    <td>
                                        {{ $vehicleEvent->name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $vehicleEvent->description ?? '' }}
                                    </td>
                                    <td>
                                        {{ $vehicleEvent->vehicle_event_type->name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $vehicleEvent->vehicle_event_warning_time->name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $vehicleEvent->vehicle_event_warning_time->days ?? '' }}
                                    </td>
                                    <td>
                                        {{ $vehicleEvent->date ?? '' }}
                                    </td>
                                    <td>
                                        <a href="/admin/vehicle-items/{{ $vehicleEvent->vehicle_item->id ?? '' }}"
                                            class="btn btn-success btn-sm">{{ $vehicleEvent->vehicle_item->license_plate
                                            ?? '' }}</a>
                                    </td>
                                    <td>
                                        <span style="display:none">{{ $vehicleEvent->sent ?? '' }}</span>
                                        <input type="checkbox" disabled="disabled" {{ $vehicleEvent->sent ? 'checked' :
                                        '' }}>
                                    </td>
                                    <td>
                                        @can('vehicle_event_show')
                                        <a class="btn btn-xs btn-primary"
                                            href="{{ route('admin.vehicle-events.show', $vehicleEvent->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                        @endcan

                                        @can('vehicle_event_edit')
                                        <a class="btn btn-xs btn-info"
                                            href="{{ route('admin.vehicle-events.edit', $vehicleEvent->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                        @endcan

                                        @can('vehicle_event_delete')
                                        <form action="{{ route('admin.vehicle-events.destroy', $vehicleEvent->id) }}"
                                            method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger"
                                                value="{{ trans('global.delete') }}">
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
@can('vehicle_event_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.vehicle-events.massDestroy') }}",
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
  let table = $('.datatable-VehicleEvent:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection