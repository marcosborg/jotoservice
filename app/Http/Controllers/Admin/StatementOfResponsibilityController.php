<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminStatementResponsibility;
use App\Models\Driver;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StatementOfResponsibilityController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('statement_of_responsibility_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $driver = Driver::where([
            'user_id' => auth()->user()->id,
        ])->first();

        $adminStatementResponsibility = AdminStatementResponsibility::where([
            'driver_id' => $driver->id,
        ])->first();

        return view('admin.statementOfResponsibilities.index')->with([
            'adminStatementResponsibility' => $adminStatementResponsibility
        ]);
    }

    public function pdf(Request $request)
    {

        $driver = Driver::where([
            'user_id' => auth()->user()->id
        ])->first();

        $adminStatementResponsibility = AdminStatementResponsibility::where([
            'driver_id' => $driver->id
        ])
            ->first();

        setlocale(LC_TIME, 'pt_PT.utf8');
        Carbon::setLocale('pt_PT');

        $pdf = Pdf::loadView('admin.adminStatementResponsibilities.show', [
            'adminStatementResponsibility' => $adminStatementResponsibility,
        ])->setOption([
                'isRemoteEnabled' => true,
                'enable_html5_parser' => true,
            ]);

        if ($request->download) {
            return $pdf->download($adminStatementResponsibility->created_at . '.pdf');
        } else {
            return $pdf->stream();
        }

    }

    public function signContract()
    {
        $driver = Driver::where([
            'user_id' => auth()->user()->id
        ])->first();

        $adminStatementResponsibility = AdminStatementResponsibility::where([
            'driver_id' => $driver->id
        ])->first();

        $adminStatementResponsibility->signed_at = date('Y-m-d');
        $adminStatementResponsibility->save();
    }

}