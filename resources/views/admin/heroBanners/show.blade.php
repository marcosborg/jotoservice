@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.heroBanner.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.hero-banners.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.heroBanner.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $heroBanner->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.heroBanner.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $heroBanner->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.heroBanner.fields.subtitle') }}
                                    </th>
                                    <td>
                                        {{ $heroBanner->subtitle }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.heroBanner.fields.button') }}
                                    </th>
                                    <td>
                                        {{ $heroBanner->button }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.heroBanner.fields.link') }}
                                    </th>
                                    <td>
                                        {{ $heroBanner->link }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.heroBanner.fields.image') }}
                                    </th>
                                    <td>
                                        @if($heroBanner->image)
                                            <a href="{{ $heroBanner->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $heroBanner->image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.hero-banners.index') }}">
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