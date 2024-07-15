<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAdminStatementResponsibilityRequest;
use App\Http\Requests\StoreAdminStatementResponsibilityRequest;
use App\Http\Requests\UpdateAdminStatementResponsibilityRequest;
use App\Models\AdminStatementResponsibility;
use App\Models\Driver;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AdminStatementResponsibilityController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('admin_statement_responsibility_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $adminStatementResponsibilities = AdminStatementResponsibility::with(['driver'])->get();

        return view('admin.adminStatementResponsibilities.index', compact('adminStatementResponsibilities'));
    }

    public function create()
    {
        abort_if(Gate::denies('admin_statement_responsibility_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drivers = Driver::all();

        return view('admin.adminStatementResponsibilities.create', compact('drivers'));
    }

    public function store(StoreAdminStatementResponsibilityRequest $request)
    {
        $adminStatementResponsibility = AdminStatementResponsibility::create($request->all());

        return redirect()->route('admin.admin-statement-responsibilities.index');
    }

    public function edit(AdminStatementResponsibility $adminStatementResponsibility)
    {
        abort_if(Gate::denies('admin_statement_responsibility_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drivers = Driver::all();

        $adminStatementResponsibility->load('driver');

        return view('admin.adminStatementResponsibilities.edit', compact('adminStatementResponsibility', 'drivers'));
    }

    public function update(UpdateAdminStatementResponsibilityRequest $request, AdminStatementResponsibility $adminStatementResponsibility)
    {
        $adminStatementResponsibility->update($request->all());

        return redirect()->route('admin.admin-statement-responsibilities.index');
    }

    public function show(AdminStatementResponsibility $adminStatementResponsibility)
    {

        abort_if(Gate::denies('admin_statement_responsibility_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        setlocale(LC_TIME, 'pt_PT.utf8');
        Carbon::setLocale('pt_PT');

        $adminStatementResponsibility->load('driver.admin_contract');

        $pdf = Pdf::loadView('admin.adminStatementResponsibilities.show', [
            'adminStatementResponsibility' => $adminStatementResponsibility,
        ])->setOption([
            'isRemoteEnabled' => true,
        ]);

        /*
        return view('admin.adminStatementResponsibilities.show')->with([
            'adminStatementResponsibility' => $adminStatementResponsibility,
        ]);
        */

        return $pdf->stream();

        //return $pdf->download($adminStatementResponsibility->created_at . '.pdf');

    }

    public function destroy(AdminStatementResponsibility $adminStatementResponsibility)
    {
        abort_if(Gate::denies('admin_statement_responsibility_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $adminStatementResponsibility->delete();

        return back();
    }

    public function massDestroy(MassDestroyAdminStatementResponsibilityRequest $request)
    {
        $adminStatementResponsibilities = AdminStatementResponsibility::find(request('ids'));

        foreach ($adminStatementResponsibilities as $adminStatementResponsibility) {
            $adminStatementResponsibility->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}