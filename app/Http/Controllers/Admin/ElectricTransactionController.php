<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyElectricTransactionRequest;
use App\Http\Requests\StoreElectricTransactionRequest;
use App\Http\Requests\UpdateElectricTransactionRequest;
use App\Models\ElectricTransaction;
use App\Models\TvdeWeek;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ElectricTransactionController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('electric_transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ElectricTransaction::with(['tvde_week'])->select(sprintf('%s.*', (new ElectricTransaction)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'electric_transaction_show';
                $editGate      = 'electric_transaction_edit';
                $deleteGate    = 'electric_transaction_delete';
                $crudRoutePart = 'electric-transactions';

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
            $table->addColumn('tvde_week_start_date', function ($row) {
                return $row->tvde_week ? $row->tvde_week->start_date : '';
            });

            $table->editColumn('card', function ($row) {
                return $row->card ? $row->card : '';
            });
            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->editColumn('total', function ($row) {
                return $row->total ? $row->total : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'tvde_week']);

            return $table->make(true);
        }

        return view('admin.electricTransactions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('electric_transaction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tvde_weeks = TvdeWeek::pluck('start_date', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.electricTransactions.create', compact('tvde_weeks'));
    }

    public function store(StoreElectricTransactionRequest $request)
    {
        $electricTransaction = ElectricTransaction::create($request->all());

        return redirect()->route('admin.electric-transactions.index');
    }

    public function edit(ElectricTransaction $electricTransaction)
    {
        abort_if(Gate::denies('electric_transaction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tvde_weeks = TvdeWeek::pluck('start_date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $electricTransaction->load('tvde_week');

        return view('admin.electricTransactions.edit', compact('electricTransaction', 'tvde_weeks'));
    }

    public function update(UpdateElectricTransactionRequest $request, ElectricTransaction $electricTransaction)
    {
        $electricTransaction->update($request->all());

        return redirect()->route('admin.electric-transactions.index');
    }

    public function show(ElectricTransaction $electricTransaction)
    {
        abort_if(Gate::denies('electric_transaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $electricTransaction->load('tvde_week');

        return view('admin.electricTransactions.show', compact('electricTransaction'));
    }

    public function destroy(ElectricTransaction $electricTransaction)
    {
        abort_if(Gate::denies('electric_transaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $electricTransaction->delete();

        return back();
    }

    public function massDestroy(MassDestroyElectricTransactionRequest $request)
    {
        $electricTransactions = ElectricTransaction::find(request('ids'));

        foreach ($electricTransactions as $electricTransaction) {
            $electricTransaction->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
