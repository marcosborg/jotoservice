@extends('layouts.admin')
@section('content')
<div class="content">
    @can('own_car_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.own-cars.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.ownCar.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.ownCar.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-OwnCar">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.ownCar.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.ownCar.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.ownCar.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.ownCar.fields.image') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ownCars as $key => $ownCar)
                                    <tr data-entry-id="{{ $ownCar->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $ownCar->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $ownCar->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $ownCar->description ?? '' }}
                                        </td>
                                        <td>
                                            @if($ownCar->image)
                                                <a href="{{ $ownCar->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $ownCar->image->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('own_car_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.own-cars.show', $ownCar->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('own_car_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.own-cars.edit', $ownCar->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('own_car_delete')
                                                <form action="{{ route('admin.own-cars.destroy', $ownCar->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('own_car_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.own-cars.massDestroy') }}",
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
  let table = $('.datatable-OwnCar:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection