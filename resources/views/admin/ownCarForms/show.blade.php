@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.ownCarForm.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.own-car-forms.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.ownCarForm.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $ownCarForm->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.ownCarForm.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $ownCarForm->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.ownCarForm.fields.phone') }}
                                    </th>
                                    <td>
                                        {{ $ownCarForm->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.ownCarForm.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $ownCarForm->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.ownCarForm.fields.city') }}
                                    </th>
                                    <td>
                                        {{ $ownCarForm->city }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.ownCarForm.fields.tvde') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $ownCarForm->tvde ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.ownCarForm.fields.tvde_card') }}
                                    </th>
                                    <td>
                                        {{ $ownCarForm->tvde_card }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.ownCarForm.fields.message') }}
                                    </th>
                                    <td>
                                        {{ $ownCarForm->message }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.ownCarForm.fields.rgpd') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $ownCarForm->rgpd ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.own-car-forms.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection