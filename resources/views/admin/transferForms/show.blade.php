@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.transferForm.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.transfer-forms.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transferForm.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $transferForm->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transferForm.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $transferForm->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transferForm.fields.phone') }}
                                    </th>
                                    <td>
                                        {{ $transferForm->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transferForm.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $transferForm->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transferForm.fields.city') }}
                                    </th>
                                    <td>
                                        {{ $transferForm->city }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transferForm.fields.rgpd') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $transferForm->rgpd ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transferForm.fields.transfer_tour') }}
                                    </th>
                                    <td>
                                        {{ $transferForm->transfer_tour->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transferForm.fields.message') }}
                                    </th>
                                    <td>
                                        {{ $transferForm->message }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.transfer-forms.index') }}">
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