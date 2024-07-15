@extends('layouts.admin')
@section('content')
<div class="content">
    @can('admin_contract_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.admin-contracts.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.adminContract.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.adminContract.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-AdminContract">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.adminContract.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.adminContract.fields.number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.adminContract.fields.driver') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.driver.fields.code') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.driver.fields.start_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.driver.fields.driver_vat') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.adminContract.fields.signed_at') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($adminContracts as $key => $adminContract)
                                    <tr data-entry-id="{{ $adminContract->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $adminContract->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $adminContract->number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $adminContract->driver->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $adminContract->driver->code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $adminContract->driver->start_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $adminContract->driver->driver_vat ?? '' }}
                                        </td>
                                        <td>
                                            {{ $adminContract->signed_at ?? '' }}
                                        </td>
                                        <td>
                                            @can('admin_contract_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.admin-contracts.show', $adminContract->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('admin_contract_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.admin-contracts.edit', $adminContract->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('admin_contract_delete')
                                                <form action="{{ route('admin.admin-contracts.destroy', $adminContract->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('admin_contract_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.admin-contracts.massDestroy') }}",
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
  let table = $('.datatable-AdminContract:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection