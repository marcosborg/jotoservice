@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.carRentalContactRequest.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.car-rental-contact-requests.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.carRentalContactRequest.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $carRentalContactRequest->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.carRentalContactRequest.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $carRentalContactRequest->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.carRentalContactRequest.fields.phone') }}
                                    </th>
                                    <td>
                                        {{ $carRentalContactRequest->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.carRentalContactRequest.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $carRentalContactRequest->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.carRentalContactRequest.fields.city') }}
                                    </th>
                                    <td>
                                        {{ $carRentalContactRequest->city }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.carRentalContactRequest.fields.tvde') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $carRentalContactRequest->tvde ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.carRentalContactRequest.fields.tvde_card') }}
                                    </th>
                                    <td>
                                        {{ $carRentalContactRequest->tvde_card }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.carRentalContactRequest.fields.car') }}
                                    </th>
                                    <td>
                                        {{ $carRentalContactRequest->car->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.carRentalContactRequest.fields.message') }}
                                    </th>
                                    <td>
                                        {{ $carRentalContactRequest->message }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.carRentalContactRequest.fields.rgpd') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $carRentalContactRequest->rgpd ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.car-rental-contact-requests.index') }}">
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