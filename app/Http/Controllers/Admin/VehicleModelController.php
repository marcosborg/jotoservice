<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVehicleModelRequest;
use App\Http\Requests\StoreVehicleModelRequest;
use App\Http\Requests\UpdateVehicleModelRequest;
use App\Models\VehicleModel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VehicleModelController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vehicle_model_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleModels = VehicleModel::all();

        return view('admin.vehicleModels.index', compact('vehicleModels'));
    }

    public function create()
    {
        abort_if(Gate::denies('vehicle_model_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vehicleModels.create');
    }

    public function store(StoreVehicleModelRequest $request)
    {
        $vehicleModel = VehicleModel::create($request->all());

        return redirect()->route('admin.vehicle-models.index');
    }

    public function edit(VehicleModel $vehicleModel)
    {
        abort_if(Gate::denies('vehicle_model_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vehicleModels.edit', compact('vehicleModel'));
    }

    public function update(UpdateVehicleModelRequest $request, VehicleModel $vehicleModel)
    {
        $vehicleModel->update($request->all());

        return redirect()->route('admin.vehicle-models.index');
    }

    public function show(VehicleModel $vehicleModel)
    {
        abort_if(Gate::denies('vehicle_model_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vehicleModels.show', compact('vehicleModel'));
    }

    public function destroy(VehicleModel $vehicleModel)
    {
        abort_if(Gate::denies('vehicle_model_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleModel->delete();

        return back();
    }

    public function massDestroy(MassDestroyVehicleModelRequest $request)
    {
        $vehicleModels = VehicleModel::find(request('ids'));

        foreach ($vehicleModels as $vehicleModel) {
            $vehicleModel->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
