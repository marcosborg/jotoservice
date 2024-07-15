<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAdjustmentRequest;
use App\Http\Requests\StoreAdjustmentRequest;
use App\Http\Requests\UpdateAdjustmentRequest;
use App\Models\Adjustment;
use App\Models\Company;
use App\Models\Driver;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AdjustmentController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('adjustment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            if (session()->has('company_id') && session()->get('company_id') !== '0') {
                $query = Adjustment::where('company_id', session()->get('company_id'))->with(['drivers', 'company'])->select(sprintf('%s.*', (new Adjustment)->table));
            } else {
                $query = Adjustment::with(['drivers', 'company'])->select(sprintf('%s.*', (new Adjustment)->table));
            }
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'adjustment_show';
                $editGate = 'adjustment_edit';
                $deleteGate = 'adjustment_delete';
                $crudRoutePart = 'adjustments';

                return view(
                    'partials.datatablesActions',
                    compact(
                        'viewGate',
                        'editGate',
                        'deleteGate',
                        'crudRoutePart',
                        'row'
                    )
                );
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? Adjustment::TYPE_RADIO[$row->type] : '';
            });
            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->editColumn('percent', function ($row) {
                return $row->percent ? $row->percent : '';
            });

            $table->editColumn('drivers', function ($row) {
                $labels = [];
                foreach ($row->drivers as $driver) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $driver->name);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('company_name', function ($row) {
                return $row->company ? $row->company->name : '';
            });

            $table->editColumn('company_expense', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->company_expense ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'drivers', 'company', 'company_expense']);

            return $table->make(true);
        }

        return view('admin.adjustments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('adjustment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drivers = Driver::pluck('name', 'id');

        $companies = Company::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.adjustments.create', compact('companies', 'drivers'));
    }

    public function store(StoreAdjustmentRequest $request)
    {
        $adjustment = Adjustment::create($request->all());
        $adjustment->drivers()->sync($request->input('drivers', []));

        return redirect()->route('admin.adjustments.index');
    }

    public function edit(Adjustment $adjustment)
    {
        abort_if(Gate::denies('adjustment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (session()->has('company_id') && session()->get('company_id') !== '0') {
            $drivers = Driver::where('company_id', session()->get('company_id'))->pluck('name', 'id');
        } else {
            $drivers = Driver::pluck('name', 'id');
        }

        $companies = Company::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $adjustment->load('drivers', 'company');

        return view('admin.adjustments.edit', compact('adjustment', 'companies', 'drivers'));
    }

    public function update(UpdateAdjustmentRequest $request, Adjustment $adjustment)
    {
        $adjustment->update($request->all());
        $adjustment->drivers()->sync($request->input('drivers', []));

        return redirect()->route('admin.adjustments.index');
    }

    public function show(Adjustment $adjustment)
    {
        abort_if(Gate::denies('adjustment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $adjustment->load('drivers', 'company');

        return view('admin.adjustments.show', compact('adjustment'));
    }

    public function destroy(Adjustment $adjustment)
    {
        abort_if(Gate::denies('adjustment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $adjustment->delete();

        return back();
    }

    public function massDestroy(MassDestroyAdjustmentRequest $request)
    {
        $adjustments = Adjustment::find(request('ids'));

        foreach ($adjustments as $adjustment) {
            $adjustment->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
