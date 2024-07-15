<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyActivityLaunchRequest;
use App\Http\Requests\StoreActivityLaunchRequest;
use App\Http\Requests\UpdateActivityLaunchRequest;
use App\Models\ActivityLaunch;
use App\Models\Driver;
use App\Models\TvdeWeek;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ActivityLaunchController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('activity_launch_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ActivityLaunch::with(['driver', 'week'])->select(sprintf('%s.*', (new ActivityLaunch)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'activity_launch_show';
                $editGate      = 'activity_launch_edit';
                $deleteGate    = 'activity_launch_delete';
                $crudRoutePart = 'activity-launches';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('driver_code', function ($row) {
                return $row->driver ? $row->driver->code : '';
            });

            $table->editColumn('driver.name', function ($row) {
                return $row->driver ? (is_string($row->driver) ? $row->driver : $row->driver->name) : '';
            });
            $table->editColumn('driver.email', function ($row) {
                return $row->driver ? (is_string($row->driver) ? $row->driver : $row->driver->email) : '';
            });
            $table->addColumn('week_start_date', function ($row) {
                return $row->week ? $row->week->start_date : '';
            });

            $table->editColumn('week.end_date', function ($row) {
                return $row->week ? (is_string($row->week) ? $row->week : $row->week->end_date) : '';
            });
            $table->editColumn('rent', function ($row) {
                return $row->rent ? $row->rent : '';
            });
            $table->editColumn('management', function ($row) {
                return $row->management ? $row->management : '';
            });
            $table->editColumn('insurance', function ($row) {
                return $row->insurance ? $row->insurance : '';
            });
            $table->editColumn('fuel', function ($row) {
                return $row->fuel ? $row->fuel : '';
            });
            $table->editColumn('tolls', function ($row) {
                return $row->tolls ? $row->tolls : '';
            });
            $table->editColumn('others', function ($row) {
                return $row->others ? $row->others : '';
            });
            $table->editColumn('refund', function ($row) {
                return $row->refund ? $row->refund : '';
            });
            $table->editColumn('send', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->send ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'driver', 'week', 'send']);

            return $table->make(true);
        }

        return view('admin.activityLaunches.index');
    }

    public function create()
    {
        abort_if(Gate::denies('activity_launch_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drivers = Driver::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $weeks = TvdeWeek::pluck('start_date', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.activityLaunches.create', compact('drivers', 'weeks'));
    }

    public function store(StoreActivityLaunchRequest $request)
    {
        $activityLaunch = ActivityLaunch::create($request->all());

        return redirect()->route('admin.activity-launches.index');
    }

    public function edit(ActivityLaunch $activityLaunch)
    {
        abort_if(Gate::denies('activity_launch_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drivers = Driver::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $weeks = TvdeWeek::pluck('start_date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $activityLaunch->load('driver', 'week');

        return view('admin.activityLaunches.edit', compact('activityLaunch', 'drivers', 'weeks'));
    }

    public function update(UpdateActivityLaunchRequest $request, ActivityLaunch $activityLaunch)
    {
        $activityLaunch->update($request->all());

        return redirect()->route('admin.activity-launches.index');
    }

    public function show(ActivityLaunch $activityLaunch)
    {
        abort_if(Gate::denies('activity_launch_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activityLaunch->load('driver', 'week', 'activityLaunchActivityPerOperators');

        return view('admin.activityLaunches.show', compact('activityLaunch'));
    }

    public function destroy(ActivityLaunch $activityLaunch)
    {
        abort_if(Gate::denies('activity_launch_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activityLaunch->delete();

        return back();
    }

    public function massDestroy(MassDestroyActivityLaunchRequest $request)
    {
        $activityLaunches = ActivityLaunch::find(request('ids'));

        foreach ($activityLaunches as $activityLaunch) {
            $activityLaunch->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}