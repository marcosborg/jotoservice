<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVehicleEventWarningTimeRequest;
use App\Http\Requests\StoreVehicleEventWarningTimeRequest;
use App\Http\Requests\UpdateVehicleEventWarningTimeRequest;
use App\Models\VehicleEventWarningTime;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VehicleEventWarningTimeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vehicle_event_warning_time_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleEventWarningTimes = VehicleEventWarningTime::all();

        return view('admin.vehicleEventWarningTimes.index', compact('vehicleEventWarningTimes'));
    }

    public function create()
    {
        abort_if(Gate::denies('vehicle_event_warning_time_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vehicleEventWarningTimes.create');
    }

    public function store(StoreVehicleEventWarningTimeRequest $request)
    {
        $vehicleEventWarningTime = VehicleEventWarningTime::create($request->all());

        return redirect()->route('admin.vehicle-event-warning-times.index');
    }

    public function edit(VehicleEventWarningTime $vehicleEventWarningTime)
    {
        abort_if(Gate::denies('vehicle_event_warning_time_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vehicleEventWarningTimes.edit', compact('vehicleEventWarningTime'));
    }

    public function update(UpdateVehicleEventWarningTimeRequest $request, VehicleEventWarningTime $vehicleEventWarningTime)
    {
        $vehicleEventWarningTime->update($request->all());

        return redirect()->route('admin.vehicle-event-warning-times.index');
    }

    public function show(VehicleEventWarningTime $vehicleEventWarningTime)
    {
        abort_if(Gate::denies('vehicle_event_warning_time_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vehicleEventWarningTimes.show', compact('vehicleEventWarningTime'));
    }

    public function destroy(VehicleEventWarningTime $vehicleEventWarningTime)
    {
        abort_if(Gate::denies('vehicle_event_warning_time_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleEventWarningTime->delete();

        return back();
    }

    public function massDestroy(MassDestroyVehicleEventWarningTimeRequest $request)
    {
        $vehicleEventWarningTimes = VehicleEventWarningTime::find(request('ids'));

        foreach ($vehicleEventWarningTimes as $vehicleEventWarningTime) {
            $vehicleEventWarningTime->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
