@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.activity.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.activities.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.activity.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $activity->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.activity.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $activity->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.activity.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $activity->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.activity.fields.button') }}
                                    </th>
                                    <td>
                                        {{ $activity->button }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.activity.fields.link') }}
                                    </th>
                                    <td>
                                        {{ $activity->link }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.activity.fields.icon') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Activity::ICON_SELECT[$activity->icon] ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.activities.index') }}">
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