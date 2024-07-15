<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDriverRequest;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Models\Card;
use App\Models\Company;
use App\Models\ContractType;
use App\Models\ContractVat;
use App\Models\Driver;
use App\Models\Electric;
use App\Models\Local;
use App\Models\State;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DriverController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('driver_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Driver::with(['user', 'card', 'electric', 'local', 'contract_type', 'contract_vat', 'state', 'company'])->select(sprintf('%s.*', (new Driver)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'driver_show';
                $editGate      = 'driver_edit';
                $deleteGate    = 'driver_delete';
                $crudRoutePart = 'drivers';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('user.email', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->email) : '';
            });
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->addColumn('card_code', function ($row) {
                return $row->card ? $row->card->code : '';
            });

            $table->addColumn('electric_code', function ($row) {
                return $row->electric ? $row->electric->code : '';
            });

            $table->addColumn('local_name', function ($row) {
                return $row->local ? $row->local->name : '';
            });

            $table->addColumn('contract_type_name', function ($row) {
                return $row->contract_type ? $row->contract_type->name : '';
            });

            $table->addColumn('contract_vat_name', function ($row) {
                return $row->contract_vat ? $row->contract_vat->name : '';
            });

            $table->editColumn('contract_vat.percent', function ($row) {
                return $row->contract_vat ? (is_string($row->contract_vat) ? $row->contract_vat : $row->contract_vat->percent) : '';
            });
            $table->editColumn('contract_vat.tips', function ($row) {
                return $row->contract_vat ? (is_string($row->contract_vat) ? $row->contract_vat : $row->contract_vat->tips) : '';
            });

            $table->editColumn('reason', function ($row) {
                return $row->reason ? $row->reason : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('payment_vat', function ($row) {
                return $row->payment_vat ? $row->payment_vat : '';
            });
            $table->editColumn('citizen_card', function ($row) {
                return $row->citizen_card ? $row->citizen_card : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('iban', function ($row) {
                return $row->iban ? $row->iban : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->editColumn('zip', function ($row) {
                return $row->zip ? $row->zip : '';
            });
            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : '';
            });
            $table->addColumn('state_name', function ($row) {
                return $row->state ? $row->state->name : '';
            });

            $table->editColumn('driver_license', function ($row) {
                return $row->driver_license ? $row->driver_license : '';
            });
            $table->editColumn('driver_vat', function ($row) {
                return $row->driver_vat ? $row->driver_vat : '';
            });
            $table->editColumn('uber_uuid', function ($row) {
                return $row->uber_uuid ? $row->uber_uuid : '';
            });
            $table->editColumn('bolt_name', function ($row) {
                return $row->bolt_name ? $row->bolt_name : '';
            });
            $table->editColumn('license_plate', function ($row) {
                return $row->license_plate ? $row->license_plate : '';
            });
            $table->editColumn('brand', function ($row) {
                return $row->brand ? $row->brand : '';
            });
            $table->editColumn('model', function ($row) {
                return $row->model ? $row->model : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });
            $table->addColumn('company_name', function ($row) {
                return $row->company ? $row->company->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'card', 'electric', 'local', 'contract_type', 'contract_vat', 'state', 'company']);

            return $table->make(true);
        }

        return view('admin.drivers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('driver_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cards = Card::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $electrics = Electric::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locals = Local::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contract_types = ContractType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contract_vats = ContractVat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companies = Company::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.drivers.create', compact('cards', 'companies', 'contract_types', 'contract_vats', 'electrics', 'locals', 'states', 'users'));
    }

    public function store(StoreDriverRequest $request)
    {
        $driver = Driver::create($request->all());

        return redirect()->route('admin.drivers.index');
    }

    public function edit(Driver $driver)
    {
        abort_if(Gate::denies('driver_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cards = Card::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $electrics = Electric::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locals = Local::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contract_types = ContractType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contract_vats = ContractVat::all();

        $states = State::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companies = Company::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $driver->load('user', 'card', 'electric', 'local', 'contract_type', 'contract_vat', 'state', 'company');

        return view('admin.drivers.edit', compact('cards', 'companies', 'contract_types', 'contract_vats', 'driver', 'electrics', 'locals', 'states', 'users'));
    }

    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        $driver->update($request->all());

        return redirect()->route('admin.drivers.index');
    }

    public function show(Driver $driver)
    {
        abort_if(Gate::denies('driver_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $driver->load('user', 'card', 'electric', 'local', 'contract_type', 'contract_vat', 'state', 'company', 'driverDocuments', 'driverReceipts');

        return view('admin.drivers.show', compact('driver'));
    }

    public function destroy(Driver $driver)
    {
        abort_if(Gate::denies('driver_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $driver->delete();

        return back();
    }

    public function massDestroy(MassDestroyDriverRequest $request)
    {
        $drivers = Driver::find(request('ids'));

        foreach ($drivers as $driver) {
            $driver->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
