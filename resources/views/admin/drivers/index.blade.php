@extends('layouts.admin')
@section('content')
<div class="content">
    @can('driver_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.drivers.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.driver.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'Driver', 'route' => 'admin.drivers.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.driver.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Driver">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>
                                    {{ trans('cruds.driver.fields.id') }}
                                </th>
                                <th>
                                    {{ trans('cruds.driver.fields.user') }}
                                </th>
                                <th>
                                    {{ trans('cruds.user.fields.email') }}
                                </th>
                                <th>
                                    {{ trans('cruds.driver.fields.code') }}
                                </th>
                                <th>
                                    {{ trans('cruds.driver.fields.card') }}
                                </th>
                                <th>
                                    {{ trans('cruds.driver.fields.electric') }}
                                </th>
                                <th>
                                    {{ trans('cruds.driver.fields.contract_type') }}
                                </th>
                                <th>
                                    {{ trans('cruds.driver.fields.contract_vat') }}
                                </th>
                                <th>
                                    {{ trans('cruds.driver.fields.state') }}
                                </th>
                                <th>
                                    {{ trans('cruds.driver.fields.uber_uuid') }}
                                </th>
                                <th>
                                    {{ trans('cruds.driver.fields.bolt_name') }}
                                </th>
                                <th>
                                    {{ trans('cruds.driver.fields.company') }}
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
@can('driver_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.drivers.massDestroy') }}",
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
    ajax: "{{ route('admin.drivers.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'user_name', name: 'user.name' },
{ data: 'user.email', name: 'user.email' },
{ data: 'code', name: 'code' },
{ data: 'card_code', name: 'card.code' },
{ data: 'electric_code', name: 'electric.code' },
{ data: 'contract_type_name', name: 'contract_type.name' },
{ data: 'contract_vat_name', name: 'contract_vat.name' },
{ data: 'state_name', name: 'state.name' },
{ data: 'uber_uuid', name: 'uber_uuid' },
{ data: 'bolt_name', name: 'bolt_name' },
{ data: 'company_name', name: 'company.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Driver').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection