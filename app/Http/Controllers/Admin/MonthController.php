<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMonthRequest;
use App\Http\Requests\StoreMonthRequest;
use App\Http\Requests\UpdateMonthRequest;
use App\Models\Month;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MonthController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('month_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $months = Month::all();

        return view('admin.months.index', compact('months'));
    }

    public function create()
    {
        abort_if(Gate::denies('month_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.months.create');
    }

    public function store(StoreMonthRequest $request)
    {
        $month = Month::create($request->all());

        return redirect()->route('admin.months.index');
    }

    public function edit(Month $month)
    {
        abort_if(Gate::denies('month_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.months.edit', compact('month'));
    }

    public function update(UpdateMonthRequest $request, Month $month)
    {
        $month->update($request->all());

        return redirect()->route('admin.months.index');
    }

    public function show(Month $month)
    {
        abort_if(Gate::denies('month_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.months.show', compact('month'));
    }

    public function destroy(Month $month)
    {
        abort_if(Gate::denies('month_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $month->delete();

        return back();
    }

    public function massDestroy(MassDestroyMonthRequest $request)
    {
        Month::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
