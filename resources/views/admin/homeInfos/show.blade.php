@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.homeInfo.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.home-infos.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.homeInfo.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $homeInfo->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.homeInfo.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $homeInfo->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.homeInfo.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $homeInfo->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.homeInfo.fields.image') }}
                                    </th>
                                    <td>
                                        @if($homeInfo->image)
                                            <a href="{{ $homeInfo->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $homeInfo->image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.homeInfo.fields.text') }}
                                    </th>
                                    <td>
                                        {!! $homeInfo->text !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.homeInfo.fields.button') }}
                                    </th>
                                    <td>
                                        {{ $homeInfo->button }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.homeInfo.fields.link') }}
                                    </th>
                                    <td>
                                        {{ $homeInfo->link }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.home-infos.index') }}">
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