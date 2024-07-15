<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStandCarFormRequest;
use App\Http\Requests\StoreStandCarFormRequest;
use App\Http\Requests\UpdateStandCarFormRequest;
use App\Models\StandCar;
use App\Models\StandCarForm;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StandCarFormController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('stand_car_form_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StandCarForm::with(['car'])->select(sprintf('%s.*', (new StandCarForm())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'stand_car_form_show';
                $editGate = 'stand_car_form_edit';
                $deleteGate = 'stand_car_form_delete';
                $crudRoutePart = 'stand-car-forms';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : '';
            });
            $table->addColumn('car_year', function ($row) {
                return $row->car ? $row->car->year : '';
            });

            $table->editColumn('car.cylinder_capacity', function ($row) {
                return $row->car ? (is_string($row->car) ? $row->car : $row->car->cylinder_capacity) : '';
            });
            $table->editColumn('car.kilometers', function ($row) {
                return $row->car ? (is_string($row->car) ? $row->car : $row->car->kilometers) : '';
            });
            $table->editColumn('car.distance', function ($row) {
                return $row->car ? (is_string($row->car) ? $row->car : $row->car->distance) : '';
            });
            $table->editColumn('car.transmision', function ($row) {
                return $row->car ? (is_string($row->car) ? $row->car : $row->car->transmision) : '';
            });
            $table->editColumn('car.battery_capacity', function ($row) {
                return $row->car ? (is_string($row->car) ? $row->car : $row->car->battery_capacity) : '';
            });
            $table->editColumn('car.power', function ($row) {
                return $row->car ? (is_string($row->car) ? $row->car : $row->car->power) : '';
            });
            $table->editColumn('message', function ($row) {
                return $row->message ? $row->message : '';
            });
            $table->editColumn('rgpd', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->rgpd ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'car', 'rgpd']);

            return $table->make(true);
        }

        return view('admin.standCarForms.index');
    }

    public function create()
    {
        abort_if(Gate::denies('stand_car_form_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cars = StandCar::pluck('year', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.standCarForms.create', compact('cars'));
    }

    public function store(StoreStandCarFormRequest $request)
    {
        $standCarForm = StandCarForm::create($request->all());

        return redirect()->route('admin.stand-car-forms.index');
    }

    public function edit(StandCarForm $standCarForm)
    {
        abort_if(Gate::denies('stand_car_form_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cars = StandCar::pluck('year', 'id')->prepend(trans('global.pleaseSelect'), '');

        $standCarForm->load('car');

        return view('admin.standCarForms.edit', compact('cars', 'standCarForm'));
    }

    public function update(UpdateStandCarFormRequest $request, StandCarForm $standCarForm)
    {
        $standCarForm->update($request->all());

        return redirect()->route('admin.stand-car-forms.index');
    }

    public function show(StandCarForm $standCarForm)
    {
        abort_if(Gate::denies('stand_car_form_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $standCarForm->load('car');

        return view('admin.standCarForms.show', compact('standCarForm'));
    }

    public function destroy(StandCarForm $standCarForm)
    {
        abort_if(Gate::denies('stand_car_form_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $standCarForm->delete();

        return back();
    }

    public function massDestroy(MassDestroyStandCarFormRequest $request)
    {
        StandCarForm::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}