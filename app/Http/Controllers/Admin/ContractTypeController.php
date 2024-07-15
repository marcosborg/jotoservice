<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyContractTypeRequest;
use App\Http\Requests\StoreContractTypeRequest;
use App\Http\Requests\UpdateContractTypeRequest;
use App\Models\ContractType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContractTypeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('contract_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contractTypes = ContractType::all();

        return view('admin.contractTypes.index', compact('contractTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('contract_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contractTypes.create');
    }

    public function store(StoreContractTypeRequest $request)
    {
        $contractType = ContractType::create($request->all());

        return redirect()->route('admin.contract-types.index');
    }

    public function edit(ContractType $contractType)
    {
        abort_if(Gate::denies('contract_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contractTypes.edit', compact('contractType'));
    }

    public function update(UpdateContractTypeRequest $request, ContractType $contractType)
    {
        $contractType->update($request->all());

        return redirect()->route('admin.contract-types.index');
    }

    public function show(ContractType $contractType)
    {
        abort_if(Gate::denies('contract_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contractTypes.show', compact('contractType'));
    }

    public function destroy(ContractType $contractType)
    {
        abort_if(Gate::denies('contract_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contractType->delete();

        return back();
    }

    public function massDestroy(MassDestroyContractTypeRequest $request)
    {
        $contractTypes = ContractType::find(request('ids'));

        foreach ($contractTypes as $contractType) {
            $contractType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
