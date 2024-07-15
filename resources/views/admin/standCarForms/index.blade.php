@extends('layouts.admin')
@section('content')
<div class="content">
    @can('stand_car_form_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.stand-car-forms.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.standCarForm.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.standCarForm.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-StandCarForm">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>
                                    {{ trans('cruds.standCarForm.fields.id') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCarForm.fields.name') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCarForm.fields.phone') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCarForm.fields.email') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCarForm.fields.city') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCarForm.fields.car') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCar.fields.cylinder_capacity') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCar.fields.kilometers') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCar.fields.distance') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCar.fields.transmision') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCar.fields.battery_capacity') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCar.fields.power') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCarForm.fields.message') }}
                                </th>
                                <th>
                                    {{ trans('cruds.standCarForm.fields.rgpd') }}
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
@can('stand_car_form_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.stand-car-forms.massDestroy') }}",
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
    ajax: "{{ route('admin.stand-car-forms.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'phone', name: 'phone' },
{ data: 'email', name: 'email' },
{ data: 'city', name: 'city' },
{ data: 'car_year', name: 'car.year' },
{ data: 'car.cylinder_capacity', name: 'car.cylinder_capacity' },
{ data: 'car.kilometers', name: 'car.kilometers' },
{ data: 'car.distance', name: 'car.distance' },
{ data: 'car.transmision', name: 'car.transmision' },
{ data: 'car.battery_capacity', name: 'car.battery_capacity' },
{ data: 'car.power', name: 'car.power' },
{ data: 'message', name: 'message' },
{ data: 'rgpd', name: 'rgpd' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-StandCarForm').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection