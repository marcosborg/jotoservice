<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTvdeYearRequest;
use App\Http\Requests\StoreTvdeYearRequest;
use App\Http\Requests\UpdateTvdeYearRequest;
use App\Models\TvdeYear;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TvdeYearController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tvde_year_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tvdeYears = TvdeYear::all();

        return view('admin.tvdeYears.index', compact('tvdeYears'));
    }

    public function create()
    {
        abort_if(Gate::denies('tvde_year_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tvdeYears.create');
    }

    public function store(StoreTvdeYearRequest $request)
    {
        $tvdeYear = TvdeYear::create($request->all());

        return redirect()->route('admin.tvde-years.index');
    }

    public function edit(TvdeYear $tvdeYear)
    {
        abort_if(Gate::denies('tvde_year_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tvdeYears.edit', compact('tvdeYear'));
    }

    public function update(UpdateTvdeYearRequest $request, TvdeYear $tvdeYear)
    {
        $tvdeYear->update($request->all());

        return redirect()->route('admin.tvde-years.index');
    }

    public function show(TvdeYear $tvdeYear)
    {
        abort_if(Gate::denies('tvde_year_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tvdeYears.show', compact('tvdeYear'));
    }

    public function destroy(TvdeYear $tvdeYear)
    {
        abort_if(Gate::denies('tvde_year_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tvdeYear->delete();

        return back();
    }

    public function massDestroy(MassDestroyTvdeYearRequest $request)
    {
        TvdeYear::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
