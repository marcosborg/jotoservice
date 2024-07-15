@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.standCarForm.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.stand-car-forms.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCarForm.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $standCarForm->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCarForm.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $standCarForm->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCarForm.fields.phone') }}
                                    </th>
                                    <td>
                                        {{ $standCarForm->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCarForm.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $standCarForm->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCarForm.fields.city') }}
                                    </th>
                                    <td>
                                        {{ $standCarForm->city }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCarForm.fields.car') }}
                                    </th>
                                    <td>
                                        {{ $standCarForm->car->year ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCarForm.fields.message') }}
                                    </th>
                                    <td>
                                        {{ $standCarForm->message }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCarForm.fields.rgpd') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $standCarForm->rgpd ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.stand-car-forms.index') }}">
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