@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.tvdeActivity.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.tvde-activities.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tvdeActivity.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $tvdeActivity->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tvdeActivity.fields.tvde_week') }}
                                    </th>
                                    <td>
                                        {{ $tvdeActivity->tvde_week->start_date ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tvdeActivity.fields.tvde_operator') }}
                                    </th>
                                    <td>
                                        {{ $tvdeActivity->tvde_operator->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tvdeActivity.fields.company') }}
                                    </th>
                                    <td>
                                        {{ $tvdeActivity->company->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tvdeActivity.fields.driver_code') }}
                                    </th>
                                    <td>
                                        {{ $tvdeActivity->driver_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tvdeActivity.fields.earnings_one') }}
                                    </th>
                                    <td>
                                        {{ $tvdeActivity->earnings_one }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tvdeActivity.fields.earnings_two') }}
                                    </th>
                                    <td>
                                        {{ $tvdeActivity->earnings_two }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.tvde-activities.index') }}">
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