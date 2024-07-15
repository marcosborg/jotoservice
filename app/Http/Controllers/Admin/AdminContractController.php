<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAdminContractRequest;
use App\Http\Requests\StoreAdminContractRequest;
use App\Http\Requests\UpdateAdminContractRequest;
use App\Models\AdminContract;
use App\Models\Driver;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AdminContractController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('admin_contract_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $adminContracts = AdminContract::with(['driver'])->get();

        return view('admin.adminContracts.index', compact('adminContracts'));
    }

    public function create()
    {
        abort_if(Gate::denies('admin_contract_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drivers = Driver::all();

        return view('admin.adminContracts.create', compact('drivers'));
    }

    public function store(StoreAdminContractRequest $request)
    {
        $adminContract = AdminContract::create($request->all());

        return redirect()->route('admin.admin-contracts.index');
    }

    public function edit(AdminContract $adminContract)
    {
        abort_if(Gate::denies('admin_contract_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drivers = Driver::all();

        $adminContract->load('driver');

        return view('admin.adminContracts.edit', compact('adminContract', 'drivers'));
    }

    public function update(UpdateAdminContractRequest $request, AdminContract $adminContract)
    {
        $adminContract->update($request->all());

        return redirect()->route('admin.admin-contracts.index');
    }

    public function show(AdminContract $adminContract)
    {
        abort_if(Gate::denies('admin_contract_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $adminContract->load('driver');

        setlocale(LC_TIME, 'pt_PT.utf8');
        Carbon::setLocale('pt_PT');

        $pdf = Pdf::loadView('admin.adminContracts.show', [
            'adminContract' => $adminContract,
        ])->setOption([
            'isRemoteEnabled' => true,
            'enable_html5_parser' => true,
        ]);

        return $pdf->stream();

        //return $pdf->download($adminContract->created_at . '.pdf');

        //return view('admin.adminContracts.show', compact('adminContract'));
    }

    public function destroy(AdminContract $adminContract)
    {
        abort_if(Gate::denies('admin_contract_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $adminContract->delete();

        return back();
    }

    public function massDestroy(MassDestroyAdminContractRequest $request)
    {
        $adminContracts = AdminContract::find(request('ids'));

        foreach ($adminContracts as $adminContract) {
            $adminContract->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}