<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTollPaymentRequest;
use App\Http\Requests\StoreTollPaymentRequest;
use App\Http\Requests\UpdateTollPaymentRequest;
use App\Models\TollPayment;
use App\Models\TvdeWeek;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TollPaymentController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('toll_payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TollPayment::with(['tvde_week'])->select(sprintf('%s.*', (new TollPayment)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'toll_payment_show';
                $editGate      = 'toll_payment_edit';
                $deleteGate    = 'toll_payment_delete';
                $crudRoutePart = 'toll-payments';

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
            $table->editColumn('total', function ($row) {
                return $row->total ? $row->total : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'tvde_week']);

            return $table->make(true);
        }

        return view('admin.tollPayments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('toll_payment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tvde_weeks = TvdeWeek::pluck('start_date', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tollPayments.create', compact('tvde_weeks'));
    }

    public function store(StoreTollPaymentRequest $request)
    {
        $tollPayment = TollPayment::create($request->all());

        return redirect()->route('admin.toll-payments.index');
    }

    public function edit(TollPayment $tollPayment)
    {
        abort_if(Gate::denies('toll_payment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tvde_weeks = TvdeWeek::pluck('start_date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tollPayment->load('tvde_week');

        return view('admin.tollPayments.edit', compact('tollPayment', 'tvde_weeks'));
    }

    public function update(UpdateTollPaymentRequest $request, TollPayment $tollPayment)
    {
        $tollPayment->update($request->all());

        return redirect()->route('admin.toll-payments.index');
    }

    public function show(TollPayment $tollPayment)
    {
        abort_if(Gate::denies('toll_payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tollPayment->load('tvde_week');

        return view('admin.tollPayments.show', compact('tollPayment'));
    }

    public function destroy(TollPayment $tollPayment)
    {
        abort_if(Gate::denies('toll_payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tollPayment->delete();

        return back();
    }

    public function massDestroy(MassDestroyTollPaymentRequest $request)
    {
        $tollPayments = TollPayment::find(request('ids'));

        foreach ($tollPayments as $tollPayment) {
            $tollPayment->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}