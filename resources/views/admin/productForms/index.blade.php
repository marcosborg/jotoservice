@extends('layouts.admin')
@section('content')
<div class="content">
    @can('product_form_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.product-forms.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.productForm.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.productForm.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ProductForm">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.productForm.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.productForm.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.productForm.fields.phone') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.productForm.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.productForm.fields.city') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.productForm.fields.rgpd') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.productForm.fields.product') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productForms as $key => $productForm)
                                    <tr data-entry-id="{{ $productForm->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $productForm->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $productForm->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $productForm->phone ?? '' }}
                                        </td>
                                        <td>
                                            {{ $productForm->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $productForm->city ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $productForm->rgpd ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $productForm->rgpd ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $productForm->product->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('product_form_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.product-forms.show', $productForm->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('product_form_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.product-forms.edit', $productForm->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('product_form_delete')
                                                <form action="{{ route('admin.product-forms.destroy', $productForm->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('product_form_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.product-forms.massDestroy') }}",
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
  let table = $('.datatable-ProductForm:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection