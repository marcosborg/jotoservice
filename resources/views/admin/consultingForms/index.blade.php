@extends('layouts.admin')
@section('content')
<div class="content">
    @can('consulting_form_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.consulting-forms.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.consultingForm.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.consultingForm.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ConsultingForm">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.consultingForm.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.consultingForm.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.consultingForm.fields.phone') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.consultingForm.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.consultingForm.fields.city') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.consultingForm.fields.message') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.consultingForm.fields.rgpd') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($consultingForms as $key => $consultingForm)
                                    <tr data-entry-id="{{ $consultingForm->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $consultingForm->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $consultingForm->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $consultingForm->phone ?? '' }}
                                        </td>
                                        <td>
                                            {{ $consultingForm->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $consultingForm->city ?? '' }}
                                        </td>
                                        <td>
                                            {{ $consultingForm->message ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $consultingForm->rgpd ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $consultingForm->rgpd ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            @can('consulting_form_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.consulting-forms.show', $consultingForm->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('consulting_form_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.consulting-forms.edit', $consultingForm->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('consulting_form_delete')
                                                <form action="{{ route('admin.consulting-forms.destroy', $consultingForm->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('consulting_form_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.consulting-forms.massDestroy') }}",
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
  let table = $('.datatable-ConsultingForm:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection