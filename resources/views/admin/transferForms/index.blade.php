@extends('layouts.admin')
@section('content')
<div class="content">
    @can('transfer_form_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.transfer-forms.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.transferForm.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.transferForm.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-TransferForm">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.transferForm.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.transferForm.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.transferForm.fields.phone') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.transferForm.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.transferForm.fields.city') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.transferForm.fields.rgpd') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.transferForm.fields.transfer_tour') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.transferTour.fields.price') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.transferTour.fields.under_consultation') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.transferForm.fields.message') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transferForms as $key => $transferForm)
                                    <tr data-entry-id="{{ $transferForm->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $transferForm->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $transferForm->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $transferForm->phone ?? '' }}
                                        </td>
                                        <td>
                                            {{ $transferForm->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $transferForm->city ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $transferForm->rgpd ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $transferForm->rgpd ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $transferForm->transfer_tour->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $transferForm->transfer_tour->price ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $transferForm->transfer_tour->under_consultation ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $transferForm->transfer_tour ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $transferForm->message ?? '' }}
                                        </td>
                                        <td>
                                            @can('transfer_form_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.transfer-forms.show', $transferForm->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('transfer_form_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.transfer-forms.edit', $transferForm->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('transfer_form_delete')
                                                <form action="{{ route('admin.transfer-forms.destroy', $transferForm->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('transfer_form_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.transfer-forms.massDestroy') }}",
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
  let table = $('.datatable-TransferForm:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection