<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyElectricRequest;
use App\Http\Requests\StoreElectricRequest;
use App\Http\Requests\UpdateElectricRequest;
use App\Models\Company;
use App\Models\Electric;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ElectricController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('electric_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (!session()->get('company_id') || session()->get('company_id') == 0) {
            $electrics = Electric::with(['company'])->get();
        } else {
            $electrics = Electric::where('company_id', session()->get('company_id'))->with(['company'])->get();
        }

        return view('admin.electrics.index', compact('electrics'));
    }

    public function create()
    {
        abort_if(Gate::denies('electric_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.electrics.create', compact('companies'));
    }

    public function store(StoreElectricRequest $request)
    {
        $electric = Electric::create($request->all());

        return redirect()->route('admin.electrics.index');
    }

    public function edit(Electric $electric)
    {
        abort_if(Gate::denies('electric_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $electric->load('company');

        return view('admin.electrics.edit', compact('companies', 'electric'));
    }

    public function update(UpdateElectricRequest $request, Electric $electric)
    {
        $electric->update($request->all());

        return redirect()->route('admin.electrics.index');
    }

    public function show(Electric $electric)
    {
        abort_if(Gate::denies('electric_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $electric->load('company');

        return view('admin.electrics.show', compact('electric'));
    }

    public function destroy(Electric $electric)
    {
        abort_if(Gate::denies('electric_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $electric->delete();

        return back();
    }

    public function massDestroy(MassDestroyElectricRequest $request)
    {
        $electrics = Electric::find(request('ids'));

        foreach ($electrics as $electric) {
            $electric->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}