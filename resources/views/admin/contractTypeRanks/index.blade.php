@extends('layouts.admin')
@section('content')
<div class="content">
    @can('contract_type_rank_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.contract-type-ranks.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.contractTypeRank.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.contractTypeRank.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ContractTypeRank">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.contractTypeRank.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contractTypeRank.fields.from') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contractTypeRank.fields.to') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contractTypeRank.fields.percent') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contractTypeRank.fields.contract_type') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contractTypeRanks as $key => $contractTypeRank)
                                    <tr data-entry-id="{{ $contractTypeRank->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $contractTypeRank->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contractTypeRank->from ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contractTypeRank->to ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contractTypeRank->percent ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contractTypeRank->contract_type->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('contract_type_rank_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.contract-type-ranks.show', $contractTypeRank->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('contract_type_rank_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.contract-type-ranks.edit', $contractTypeRank->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('contract_type_rank_delete')
                                                <form action="{{ route('admin.contract-type-ranks.destroy', $contractTypeRank->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('contract_type_rank_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.contract-type-ranks.massDestroy') }}",
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
  let table = $('.datatable-ContractTypeRank:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection