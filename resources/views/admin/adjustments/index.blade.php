@extends('layouts.admin')
@section('content')
<div class="content">
    @can('adjustment_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.adjustments.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.adjustment.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'Adjustment', 'route' => 'admin.adjustments.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.adjustment.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Adjustment">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>
                                    {{ trans('cruds.adjustment.fields.id') }}
                                </th>
                                <th>
                                    {{ trans('cruds.adjustment.fields.name') }}
                                </th>
                                <th>
                                    {{ trans('cruds.adjustment.fields.type') }}
                                </th>
                                <th>
                                    {{ trans('cruds.adjustment.fields.amount') }}
                                </th>
                                <th>
                                    {{ trans('cruds.adjustment.fields.percent') }}
                                </th>
                                <th>
                                    {{ trans('cruds.adjustment.fields.start_date') }}
                                </th>
                                <th>
                                    {{ trans('cruds.adjustment.fields.end_date') }}
                                </th>
                                <th>
                                    {{ trans('cruds.adjustment.fields.drivers') }}
                                </th>
                                <th>
                                    {{ trans('cruds.adjustment.fields.company') }}
                                </th>
                                <th>
                                    {{ trans('cruds.adjustment.fields.company_expense') }}
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
@can('adjustment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.adjustments.massDestroy') }}",
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
    ajax: "{{ route('admin.adjustments.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'type', name: 'type' },
{ data: 'amount', name: 'amount' },
{ data: 'percent', name: 'percent' },
{ data: 'start_date', name: 'start_date' },
{ data: 'end_date', name: 'end_date' },
{ data: 'drivers', name: 'drivers.code' },
{ data: 'company_name', name: 'company.name' },
{ data: 'company_expense', name: 'company_expense' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Adjustment').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection