<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminContract;
use App\Models\Driver;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContractController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('contract_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $driver = Driver::where([
            'user_id' => auth()->user()->id
        ])->first();

        $adminContract = AdminContract::where([
            'driver_id' => $driver->id
        ])->first();

        return view('admin.contracts.index')->with([
            'adminContract' => $adminContract
        ]);
    }

    public function pdf(Request $request)
    {

        $driver = Driver::where([
            'user_id' => auth()->user()->id
        ])->first();

        $adminContract = AdminContract::where([
            'driver_id' => $driver->id
        ])->first();

        setlocale(LC_TIME, 'pt_PT.utf8');
        Carbon::setLocale('pt_PT');

        $pdf = PDF::loadView('admin.adminContracts.show', [
            'adminContract' => $adminContract,
        ])->setOption([
                'isRemoteEnabled' => true,
                'enable_html5_parser' => true,
            ]);

        if ($request->download) {
            return $pdf->download($adminContract->created_at . '.pdf');
        } else {
            return $pdf->stream();
        }

    }

    public function signContract()
    {
        $driver = Driver::where([
            'user_id' => auth()->user()->id
        ])->first();

        $adminContract = AdminContract::where([
            'driver_id' => $driver->id
        ])->first();

        $adminContract->signed_at = date('Y-m-d');
        $adminContract->save();
    }

}