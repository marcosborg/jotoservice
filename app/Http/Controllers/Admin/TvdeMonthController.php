<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTvdeMonthRequest;
use App\Http\Requests\StoreTvdeMonthRequest;
use App\Http\Requests\UpdateTvdeMonthRequest;
use App\Models\TvdeMonth;
use App\Models\TvdeYear;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TvdeMonthController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tvde_month_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tvdeMonths = TvdeMonth::with(['year'])->get();

        return view('admin.tvdeMonths.index', compact('tvdeMonths'));
    }

    public function create()
    {
        abort_if(Gate::denies('tvde_month_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $years = TvdeYear::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tvdeMonths.create', compact('years'));
    }

    public function store(StoreTvdeMonthRequest $request)
    {
        $tvdeMonth = TvdeMonth::create($request->all());

        return redirect()->route('admin.tvde-months.index');
    }

    public function edit(TvdeMonth $tvdeMonth)
    {
        abort_if(Gate::denies('tvde_month_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $years = TvdeYear::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tvdeMonth->load('year');

        return view('admin.tvdeMonths.edit', compact('tvdeMonth', 'years'));
    }

    public function update(UpdateTvdeMonthRequest $request, TvdeMonth $tvdeMonth)
    {
        $tvdeMonth->update($request->all());

        return redirect()->route('admin.tvde-months.index');
    }

    public function show(TvdeMonth $tvdeMonth)
    {
        abort_if(Gate::denies('tvde_month_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tvdeMonth->load('year');

        return view('admin.tvdeMonths.show', compact('tvdeMonth'));
    }

    public function destroy(TvdeMonth $tvdeMonth)
    {
        abort_if(Gate::denies('tvde_month_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tvdeMonth->delete();

        return back();
    }

    public function massDestroy(MassDestroyTvdeMonthRequest $request)
    {
        TvdeMonth::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
