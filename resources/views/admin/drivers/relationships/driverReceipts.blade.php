<div class="content">
    @can('receipt_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.receipts.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.receipt.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.receipt.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-driverReceipts">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.receipt.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.receipt.fields.driver') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.driver.fields.code') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.receipt.fields.value') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.receipt.fields.file') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.receipt.fields.paid') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.receipt.fields.created_at') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($receipts as $key => $receipt)
                                    <tr data-entry-id="{{ $receipt->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $receipt->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $receipt->driver->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $receipt->driver->code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $receipt->value ?? '' }}
                                        </td>
                                        <td>
                                            @if($receipt->file)
                                                <a href="{{ $receipt->file->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $receipt->paid ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $receipt->paid ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $receipt->created_at ?? '' }}
                                        </td>
                                        <td>
                                            @can('receipt_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.receipts.show', $receipt->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('receipt_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.receipts.edit', $receipt->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('receipt_delete')
                                                <form action="{{ route('admin.receipts.destroy', $receipt->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('receipt_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.receipts.massDestroy') }}",
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
  let table = $('.datatable-driverReceipts:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection