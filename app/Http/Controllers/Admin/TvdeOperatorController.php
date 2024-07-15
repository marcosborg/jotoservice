<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTvdeOperatorRequest;
use App\Http\Requests\StoreTvdeOperatorRequest;
use App\Http\Requests\UpdateTvdeOperatorRequest;
use App\Models\TvdeOperator;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TvdeOperatorController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('tvde_operator_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TvdeOperator::query()->select(sprintf('%s.*', (new TvdeOperator)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'tvde_operator_show';
                $editGate      = 'tvde_operator_edit';
                $deleteGate    = 'tvde_operator_delete';
                $crudRoutePart = 'tvde-operators';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.tvdeOperators.index');
    }

    public function create()
    {
        abort_if(Gate::denies('tvde_operator_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tvdeOperators.create');
    }

    public function store(StoreTvdeOperatorRequest $request)
    {
        $tvdeOperator = TvdeOperator::create($request->all());

        return redirect()->route('admin.tvde-operators.index');
    }

    public function edit(TvdeOperator $tvdeOperator)
    {
        abort_if(Gate::denies('tvde_operator_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tvdeOperators.edit', compact('tvdeOperator'));
    }

    public function update(UpdateTvdeOperatorRequest $request, TvdeOperator $tvdeOperator)
    {
        $tvdeOperator->update($request->all());

        return redirect()->route('admin.tvde-operators.index');
    }

    public function show(TvdeOperator $tvdeOperator)
    {
        abort_if(Gate::denies('tvde_operator_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tvdeOperators.show', compact('tvdeOperator'));
    }

    public function destroy(TvdeOperator $tvdeOperator)
    {
        abort_if(Gate::denies('tvde_operator_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tvdeOperator->delete();

        return back();
    }

    public function massDestroy(MassDestroyTvdeOperatorRequest $request)
    {
        $tvdeOperators = TvdeOperator::find(request('ids'));

        foreach ($tvdeOperators as $tvdeOperator) {
            $tvdeOperator->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
