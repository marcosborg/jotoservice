@extends('layouts.admin')
@section('content')
<div class="content">
    @can('hero_banner_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.hero-banners.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.heroBanner.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.heroBanner.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-HeroBanner">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.heroBanner.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.heroBanner.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.heroBanner.fields.subtitle') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.heroBanner.fields.button') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.heroBanner.fields.link') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.heroBanner.fields.image') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($heroBanners as $key => $heroBanner)
                                    <tr data-entry-id="{{ $heroBanner->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $heroBanner->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $heroBanner->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $heroBanner->subtitle ?? '' }}
                                        </td>
                                        <td>
                                            {{ $heroBanner->button ?? '' }}
                                        </td>
                                        <td>
                                            {{ $heroBanner->link ?? '' }}
                                        </td>
                                        <td>
                                            @if($heroBanner->image)
                                                <a href="{{ $heroBanner->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $heroBanner->image->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('hero_banner_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.hero-banners.show', $heroBanner->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('hero_banner_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.hero-banners.edit', $heroBanner->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('hero_banner_delete')
                                                <form action="{{ route('admin.hero-banners.destroy', $heroBanner->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('hero_banner_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.hero-banners.massDestroy') }}",
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
  let table = $('.datatable-HeroBanner:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection