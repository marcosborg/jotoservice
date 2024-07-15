@extends('layouts.admin')
@section('content')
<div class="content">
    @can('contract_vat_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.contract-vats.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.contractVat.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.contractVat.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ContractVat">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.contractVat.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contractVat.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contractVat.fields.percent') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contractVat.fields.tips') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contractVat.fields.contract_type') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contractVats as $key => $contractVat)
                                    <tr data-entry-id="{{ $contractVat->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $contractVat->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contractVat->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contractVat->percent ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contractVat->tips ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contractVat->contract_type->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('contract_vat_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.contract-vats.show', $contractVat->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('contract_vat_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.contract-vats.edit', $contractVat->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('contract_vat_delete')
                                                <form action="{{ route('admin.contract-vats.destroy', $contractVat->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('contract_vat_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.contract-vats.massDestroy') }}",
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
  let table = $('.datatable-ContractVat:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection