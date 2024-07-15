<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFuelRequest;
use App\Http\Requests\StoreFuelRequest;
use App\Http\Requests\UpdateFuelRequest;
use App\Models\Fuel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FuelController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fuel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fuels = Fuel::all();

        return view('admin.fuels.index', compact('fuels'));
    }

    public function create()
    {
        abort_if(Gate::denies('fuel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fuels.create');
    }

    public function store(StoreFuelRequest $request)
    {
        $fuel = Fuel::create($request->all());

        return redirect()->route('admin.fuels.index');
    }

    public function edit(Fuel $fuel)
    {
        abort_if(Gate::denies('fuel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fuels.edit', compact('fuel'));
    }

    public function update(UpdateFuelRequest $request, Fuel $fuel)
    {
        $fuel->update($request->all());

        return redirect()->route('admin.fuels.index');
    }

    public function show(Fuel $fuel)
    {
        abort_if(Gate::denies('fuel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fuels.show', compact('fuel'));
    }

    public function destroy(Fuel $fuel)
    {
        abort_if(Gate::denies('fuel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fuel->delete();

        return back();
    }

    public function massDestroy(MassDestroyFuelRequest $request)
    {
        Fuel::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
