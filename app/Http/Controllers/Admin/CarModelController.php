<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCarModelRequest;
use App\Http\Requests\StoreCarModelRequest;
use App\Http\Requests\UpdateCarModelRequest;
use App\Models\Brand;
use App\Models\CarModel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarModelController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('car_model_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carModels = CarModel::with(['brand'])->get();

        return view('admin.carModels.index', compact('carModels'));
    }

    public function create()
    {
        abort_if(Gate::denies('car_model_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brands = Brand::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.carModels.create', compact('brands'));
    }

    public function store(StoreCarModelRequest $request)
    {
        $carModel = CarModel::create($request->all());

        return redirect()->route('admin.car-models.index');
    }

    public function edit(CarModel $carModel)
    {
        abort_if(Gate::denies('car_model_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brands = Brand::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $carModel->load('brand');

        return view('admin.carModels.edit', compact('brands', 'carModel'));
    }

    public function update(UpdateCarModelRequest $request, CarModel $carModel)
    {
        $carModel->update($request->all());

        return redirect()->route('admin.car-models.index');
    }

    public function show(CarModel $carModel)
    {
        abort_if(Gate::denies('car_model_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carModel->load('brand');

        return view('admin.carModels.show', compact('carModel'));
    }

    public function destroy(CarModel $carModel)
    {
        abort_if(Gate::denies('car_model_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carModel->delete();

        return back();
    }

    public function massDestroy(MassDestroyCarModelRequest $request)
    {
        CarModel::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
