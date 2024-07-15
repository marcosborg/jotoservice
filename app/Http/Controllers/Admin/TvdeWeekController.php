<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTvdeWeekRequest;
use App\Http\Requests\StoreTvdeWeekRequest;
use App\Http\Requests\UpdateTvdeWeekRequest;
use App\Models\TvdeMonth;
use App\Models\TvdeWeek;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TvdeWeekController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tvde_week_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tvdeWeeks = TvdeWeek::with(['tvde_month'])->get();

        return view('admin.tvdeWeeks.index', compact('tvdeWeeks'));
    }

    public function create()
    {
        abort_if(Gate::denies('tvde_week_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tvde_months = TvdeMonth::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tvdeWeeks.create', compact('tvde_months'));
    }

    public function store(StoreTvdeWeekRequest $request)
    {
        $tvdeWeek = TvdeWeek::create($request->all());

        return redirect()->route('admin.tvde-weeks.index');
    }

    public function edit(TvdeWeek $tvdeWeek)
    {
        abort_if(Gate::denies('tvde_week_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tvde_months = TvdeMonth::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tvdeWeek->load('tvde_month');

        return view('admin.tvdeWeeks.edit', compact('tvdeWeek', 'tvde_months'));
    }

    public function update(UpdateTvdeWeekRequest $request, TvdeWeek $tvdeWeek)
    {
        $tvdeWeek->update($request->all());

        return redirect()->route('admin.tvde-weeks.index');
    }

    public function show(TvdeWeek $tvdeWeek)
    {
        abort_if(Gate::denies('tvde_week_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tvdeWeek->load('tvde_month');

        return view('admin.tvdeWeeks.show', compact('tvdeWeek'));
    }

    public function destroy(TvdeWeek $tvdeWeek)
    {
        abort_if(Gate::denies('tvde_week_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tvdeWeek->delete();

        return back();
    }

    public function massDestroy(MassDestroyTvdeWeekRequest $request)
    {
        $tvdeWeeks = TvdeWeek::find(request('ids'));

        foreach ($tvdeWeeks as $tvdeWeek) {
            $tvdeWeek->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}