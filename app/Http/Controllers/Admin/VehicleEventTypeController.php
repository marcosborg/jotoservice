<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVehicleEventTypeRequest;
use App\Http\Requests\StoreVehicleEventTypeRequest;
use App\Http\Requests\UpdateVehicleEventTypeRequest;
use App\Models\VehicleEventType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VehicleEventTypeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vehicle_event_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleEventTypes = VehicleEventType::all();

        return view('admin.vehicleEventTypes.index', compact('vehicleEventTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('vehicle_event_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vehicleEventTypes.create');
    }

    public function store(StoreVehicleEventTypeRequest $request)
    {
        $vehicleEventType = VehicleEventType::create($request->all());

        return redirect()->route('admin.vehicle-event-types.index');
    }

    public function edit(VehicleEventType $vehicleEventType)
    {
        abort_if(Gate::denies('vehicle_event_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vehicleEventTypes.edit', compact('vehicleEventType'));
    }

    public function update(UpdateVehicleEventTypeRequest $request, VehicleEventType $vehicleEventType)
    {
        $vehicleEventType->update($request->all());

        return redirect()->route('admin.vehicle-event-types.index');
    }

    public function show(VehicleEventType $vehicleEventType)
    {
        abort_if(Gate::denies('vehicle_event_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vehicleEventTypes.show', compact('vehicleEventType'));
    }

    public function destroy(VehicleEventType $vehicleEventType)
    {
        abort_if(Gate::denies('vehicle_event_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleEventType->delete();

        return back();
    }

    public function massDestroy(MassDestroyVehicleEventTypeRequest $request)
    {
        $vehicleEventTypes = VehicleEventType::find(request('ids'));

        foreach ($vehicleEventTypes as $vehicleEventType) {
            $vehicleEventType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
