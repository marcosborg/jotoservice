@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.driver.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.drivers.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $driver->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $driver->user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.code') }}
                                    </th>
                                    <td>
                                        {{ $driver->code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $driver->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.card') }}
                                    </th>
                                    <td>
                                        {{ $driver->card->code ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.electric') }}
                                    </th>
                                    <td>
                                        {{ $driver->electric->code ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.local') }}
                                    </th>
                                    <td>
                                        {{ $driver->local->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.contract_type') }}
                                    </th>
                                    <td>
                                        {{ $driver->contract_type->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.contract_vat') }}
                                    </th>
                                    <td>
                                        {{ $driver->contract_vat->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.start_date') }}
                                    </th>
                                    <td>
                                        {{ $driver->start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.end_date') }}
                                    </th>
                                    <td>
                                        {{ $driver->end_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.reason') }}
                                    </th>
                                    <td>
                                        {{ $driver->reason }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.phone') }}
                                    </th>
                                    <td>
                                        {{ $driver->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.payment_vat') }}
                                    </th>
                                    <td>
                                        {{ $driver->payment_vat }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.citizen_card') }}
                                    </th>
                                    <td>
                                        {{ $driver->citizen_card }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $driver->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.iban') }}
                                    </th>
                                    <td>
                                        {{ $driver->iban }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.address') }}
                                    </th>
                                    <td>
                                        {{ $driver->address }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.zip') }}
                                    </th>
                                    <td>
                                        {{ $driver->zip }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.city') }}
                                    </th>
                                    <td>
                                        {{ $driver->city }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.state') }}
                                    </th>
                                    <td>
                                        {{ $driver->state->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.driver_license') }}
                                    </th>
                                    <td>
                                        {{ $driver->driver_license }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.driver_vat') }}
                                    </th>
                                    <td>
                                        {{ $driver->driver_vat }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.uber_uuid') }}
                                    </th>
                                    <td>
                                        {{ $driver->uber_uuid }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.bolt_name') }}
                                    </th>
                                    <td>
                                        {{ $driver->bolt_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.license_plate') }}
                                    </th>
                                    <td>
                                        {{ $driver->license_plate }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.brand') }}
                                    </th>
                                    <td>
                                        {{ $driver->brand }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.model') }}
                                    </th>
                                    <td>
                                        {{ $driver->model }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.notes') }}
                                    </th>
                                    <td>
                                        {{ $driver->notes }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.company') }}
                                    </th>
                                    <td>
                                        {{ $driver->company->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.drivers.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.relatedData') }}
                </div>
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li role="presentation">
                        <a href="#driver_documents" aria-controls="driver_documents" role="tab" data-toggle="tab">
                            {{ trans('cruds.document.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#driver_receipts" aria-controls="driver_receipts" role="tab" data-toggle="tab">
                            {{ trans('cruds.receipt.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="driver_documents">
                        @includeIf('admin.drivers.relationships.driverDocuments', ['documents' => $driver->driverDocuments])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="driver_receipts">
                        @includeIf('admin.drivers.relationships.driverReceipts', ['receipts' => $driver->driverReceipts])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection