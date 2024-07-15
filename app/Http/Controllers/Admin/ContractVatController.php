<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyContractVatRequest;
use App\Http\Requests\StoreContractVatRequest;
use App\Http\Requests\UpdateContractVatRequest;
use App\Models\ContractType;
use App\Models\ContractVat;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContractVatController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('contract_vat_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contractVats = ContractVat::with(['contract_type'])->get();

        return view('admin.contractVats.index', compact('contractVats'));
    }

    public function create()
    {
        abort_if(Gate::denies('contract_vat_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contract_types = ContractType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.contractVats.create', compact('contract_types'));
    }

    public function store(StoreContractVatRequest $request)
    {
        $contractVat = ContractVat::create($request->all());

        return redirect()->route('admin.contract-vats.index');
    }

    public function edit(ContractVat $contractVat)
    {
        abort_if(Gate::denies('contract_vat_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contract_types = ContractType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contractVat->load('contract_type');

        return view('admin.contractVats.edit', compact('contractVat', 'contract_types'));
    }

    public function update(UpdateContractVatRequest $request, ContractVat $contractVat)
    {
        $contractVat->update($request->all());

        return redirect()->route('admin.contract-vats.index');
    }

    public function show(ContractVat $contractVat)
    {
        abort_if(Gate::denies('contract_vat_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contractVat->load('contract_type');

        return view('admin.contractVats.show', compact('contractVat'));
    }

    public function destroy(ContractVat $contractVat)
    {
        abort_if(Gate::denies('contract_vat_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contractVat->delete();

        return back();
    }

    public function massDestroy(MassDestroyContractVatRequest $request)
    {
        $contractVats = ContractVat::find(request('ids'));

        foreach ($contractVats as $contractVat) {
            $contractVat->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
