@extends('layouts.admin')
@section('content')
<div class="content">
    @can('car_rental_contact_request_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.car-rental-contact-requests.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.carRentalContactRequest.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.carRentalContactRequest.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-CarRentalContactRequest">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>
                                    {{ trans('cruds.carRentalContactRequest.fields.id') }}
                                </th>
                                <th>
                                    {{ trans('cruds.carRentalContactRequest.fields.name') }}
                                </th>
                                <th>
                                    {{ trans('cruds.carRentalContactRequest.fields.phone') }}
                                </th>
                                <th>
                                    {{ trans('cruds.carRentalContactRequest.fields.email') }}
                                </th>
                                <th>
                                    {{ trans('cruds.carRentalContactRequest.fields.city') }}
                                </th>
                                <th>
                                    {{ trans('cruds.carRentalContactRequest.fields.tvde') }}
                                </th>
                                <th>
                                    {{ trans('cruds.carRentalContactRequest.fields.tvde_card') }}
                                </th>
                                <th>
                                    {{ trans('cruds.carRentalContactRequest.fields.car') }}
                                </th>
                                <th>
                                    {{ trans('cruds.car.fields.subtitle') }}
                                </th>
                                <th>
                                    {{ trans('cruds.car.fields.price') }}
                                </th>
                                <th>
                                    {{ trans('cruds.carRentalContactRequest.fields.message') }}
                                </th>
                                <th>
                                    {{ trans('cruds.carRentalContactRequest.fields.rgpd') }}
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
@can('car_rental_contact_request_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.car-rental-contact-requests.massDestroy') }}",
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
    ajax: "{{ route('admin.car-rental-contact-requests.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'phone', name: 'phone' },
{ data: 'email', name: 'email' },
{ data: 'city', name: 'city' },
{ data: 'tvde', name: 'tvde' },
{ data: 'tvde_card', name: 'tvde_card' },
{ data: 'car_title', name: 'car.title' },
{ data: 'car.subtitle', name: 'car.subtitle' },
{ data: 'car.price', name: 'car.price' },
{ data: 'message', name: 'message' },
{ data: 'rgpd', name: 'rgpd' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-CarRentalContactRequest').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection