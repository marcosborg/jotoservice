<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVehicleEventRequest;
use App\Http\Requests\StoreVehicleEventRequest;
use App\Http\Requests\UpdateVehicleEventRequest;
use App\Models\VehicleEvent;
use App\Models\VehicleEventType;
use App\Models\VehicleEventWarningTime;
use App\Models\VehicleItem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VehicleEventController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vehicle_event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleEvents = VehicleEvent::with(['vehicle_event_type', 'vehicle_event_warning_time', 'vehicle_item'])->get();

        return view('admin.vehicleEvents.index', compact('vehicleEvents'));
    }

    public function create()
    {
        abort_if(Gate::denies('vehicle_event_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicle_event_types = VehicleEventType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicle_event_warning_times = VehicleEventWarningTime::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicle_items = VehicleItem::pluck('license_plate', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.vehicleEvents.create', compact('vehicle_event_types', 'vehicle_event_warning_times', 'vehicle_items'));
    }

    public function store(StoreVehicleEventRequest $request)
    {
        $vehicleEvent = VehicleEvent::create($request->all());

        return redirect()->route('admin.vehicle-events.index');
    }

    public function edit(VehicleEvent $vehicleEvent)
    {
        abort_if(Gate::denies('vehicle_event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicle_event_types = VehicleEventType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicle_event_warning_times = VehicleEventWarningTime::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicle_items = VehicleItem::pluck('license_plate', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicleEvent->load('vehicle_event_type', 'vehicle_event_warning_time', 'vehicle_item');

        return view('admin.vehicleEvents.edit', compact('vehicleEvent', 'vehicle_event_types', 'vehicle_event_warning_times', 'vehicle_items'));
    }

    public function update(UpdateVehicleEventRequest $request, VehicleEvent $vehicleEvent)
    {
        $vehicleEvent->update($request->all());

        return redirect()->route('admin.vehicle-events.index');
    }

    public function show(VehicleEvent $vehicleEvent)
    {
        abort_if(Gate::denies('vehicle_event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleEvent->load('vehicle_event_type', 'vehicle_event_warning_time', 'vehicle_item');

        return view('admin.vehicleEvents.show', compact('vehicleEvent'));
    }

    public function destroy(VehicleEvent $vehicleEvent)
    {
        abort_if(Gate::denies('vehicle_event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleEvent->delete();

        return back();
    }

    public function massDestroy(MassDestroyVehicleEventRequest $request)
    {
        $vehicleEvents = VehicleEvent::find(request('ids'));

        foreach ($vehicleEvents as $vehicleEvent) {
            $vehicleEvent->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
