@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.standCar.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.stand-cars.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCar.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $standCar->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCar.fields.brand') }}
                                    </th>
                                    <td>
                                        {{ $standCar->brand->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCar.fields.car_model') }}
                                    </th>
                                    <td>
                                        {{ $standCar->car_model->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCar.fields.fuel') }}
                                    </th>
                                    <td>
                                        {{ $standCar->fuel->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCar.fields.transmision') }}
                                    </th>
                                    <td>
                                        {{ App\Models\StandCar::TRANSMISION_RADIO[$standCar->transmision] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCar.fields.cylinder_capacity') }}
                                    </th>
                                    <td>
                                        {{ $standCar->cylinder_capacity }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCar.fields.battery_capacity') }}
                                    </th>
                                    <td>
                                        {{ $standCar->battery_capacity }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCar.fields.year') }}
                                    </th>
                                    <td>
                                        {{ $standCar->year }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCar.fields.month') }}
                                    </th>
                                    <td>
                                        {{ $standCar->month->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCar.fields.kilometers') }}
                                    </th>
                                    <td>
                                        {{ $standCar->kilometers }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCar.fields.power') }}
                                    </th>
                                    <td>
                                        {{ $standCar->power }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCar.fields.origin') }}
                                    </th>
                                    <td>
                                        {{ $standCar->origin->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCar.fields.distance') }}
                                    </th>
                                    <td>
                                        {{ $standCar->distance }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCar.fields.price') }}
                                    </th>
                                    <td>
                                        {{ $standCar->price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCar.fields.status') }}
                                    </th>
                                    <td>
                                        {{ $standCar->status->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.standCar.fields.images') }}
                                    </th>
                                    <td>
                                        @foreach($standCar->images as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.stand-cars.index') }}">
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