@extends('layouts.admin')
@section('content')
<div class="content">
    @can('stand_car_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.stand-cars.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.standCar.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.standCar.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-StandCar">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>
                                    {{ trans('cruds.standCar.fields.id') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCar.fields.brand') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCar.fields.car_model') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCar.fields.fuel') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCar.fields.transmision') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCar.fields.cylinder_capacity') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCar.fields.battery_capacity') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCar.fields.year') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCar.fields.month') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCar.fields.kilometers') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCar.fields.power') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCar.fields.origin') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCar.fields.distance') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCar.fields.price') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCar.fields.status') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCar.fields.images') }}
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                    </table>
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
@can('stand_car_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.stand-cars.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.stand-cars.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'brand_name', name: 'brand.name' },
{ data: 'car_model_name', name: 'car_model.name' },
{ data: 'fuel_name', name: 'fuel.name' },
{ data: 'transmision', name: 'transmision' },
{ data: 'cylinder_capacity', name: 'cylinder_capacity' },
{ data: 'battery_capacity', name: 'battery_capacity' },
{ data: 'year', name: 'year' },
{ data: 'month_name', name: 'month.name' },
{ data: 'kilometers', name: 'kilometers' },
{ data: 'power', name: 'power' },
{ data: 'origin_name', name: 'origin.name' },
{ data: 'distance', name: 'distance' },
{ data: 'price', name: 'price' },
{ data: 'status_name', name: 'status.name' },
{ data: 'images', name: 'images', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-StandCar').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection