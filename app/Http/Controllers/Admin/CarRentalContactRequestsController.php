<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCarRentalContactRequestRequest;
use App\Http\Requests\StoreCarRentalContactRequestRequest;
use App\Http\Requests\UpdateCarRentalContactRequestRequest;
use App\Models\Car;
use App\Models\CarRentalContactRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CarRentalContactRequestsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('car_rental_contact_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CarRentalContactRequest::with(['car'])->select(sprintf('%s.*', (new CarRentalContactRequest())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'car_rental_contact_request_show';
                $editGate = 'car_rental_contact_request_edit';
                $deleteGate = 'car_rental_contact_request_delete';
                $crudRoutePart = 'car-rental-contact-requests';

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
            $table->editColumn('tvde', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->tvde ? 'checked' : null) . '>';
            });
            $table->editColumn('tvde_card', function ($row) {
                return $row->tvde_card ? $row->tvde_card : '';
            });
            $table->addColumn('car_title', function ($row) {
                return $row->car ? $row->car->title : '';
            });

            $table->editColumn('car.subtitle', function ($row) {
                return $row->car ? (is_string($row->car) ? $row->car : $row->car->subtitle) : '';
            });
            $table->editColumn('car.price', function ($row) {
                return $row->car ? (is_string($row->car) ? $row->car : $row->car->price) : '';
            });
            $table->editColumn('message', function ($row) {
                return $row->message ? $row->message : '';
            });
            $table->editColumn('rgpd', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->rgpd ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'tvde', 'car', 'rgpd']);

            return $table->make(true);
        }

        return view('admin.carRentalContactRequests.index');
    }

    public function create()
    {
        abort_if(Gate::denies('car_rental_contact_request_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cars = Car::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.carRentalContactRequests.create', compact('cars'));
    }

    public function store(StoreCarRentalContactRequestRequest $request)
    {
        $carRentalContactRequest = CarRentalContactRequest::create($request->all());

        return redirect()->route('admin.car-rental-contact-requests.index');
    }

    public function edit(CarRentalContactRequest $carRentalContactRequest)
    {
        abort_if(Gate::denies('car_rental_contact_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cars = Car::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $carRentalContactRequest->load('car');

        return view('admin.carRentalContactRequests.edit', compact('carRentalContactRequest', 'cars'));
    }

    public function update(UpdateCarRentalContactRequestRequest $request, CarRentalContactRequest $carRentalContactRequest)
    {
        $carRentalContactRequest->update($request->all());

        return redirect()->route('admin.car-rental-contact-requests.index');
    }

    public function show(CarRentalContactRequest $carRentalContactRequest)
    {
        abort_if(Gate::denies('car_rental_contact_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carRentalContactRequest->load('car');

        return view('admin.carRentalContactRequests.show', compact('carRentalContactRequest'));
    }

    public function destroy(CarRentalContactRequest $carRentalContactRequest)
    {
        abort_if(Gate::denies('car_rental_contact_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carRentalContactRequest->delete();

        return back();
    }

    public function massDestroy(MassDestroyCarRentalContactRequestRequest $request)
    {
        CarRentalContactRequest::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
