@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.companyExpense.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.company-expenses.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.companyExpense.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $companyExpense->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.companyExpense.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $companyExpense->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.companyExpense.fields.company') }}
                                    </th>
                                    <td>
                                        {{ $companyExpense->company->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.companyExpense.fields.weekly_value') }}
                                    </th>
                                    <td>
                                        {{ $companyExpense->weekly_value }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.companyExpense.fields.start_date') }}
                                    </th>
                                    <td>
                                        {{ $companyExpense->start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.companyExpense.fields.end_date') }}
                                    </th>
                                    <td>
                                        {{ $companyExpense->end_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.companyExpense.fields.qty') }}
                                    </th>
                                    <td>
                                        {{ $companyExpense->qty }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.company-expenses.index') }}">
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