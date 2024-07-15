<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyContractTypeRankRequest;
use App\Http\Requests\StoreContractTypeRankRequest;
use App\Http\Requests\UpdateContractTypeRankRequest;
use App\Models\ContractType;
use App\Models\ContractTypeRank;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContractTypeRankController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('contract_type_rank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contractTypeRanks = ContractTypeRank::with(['contract_type'])->get();

        return view('admin.contractTypeRanks.index', compact('contractTypeRanks'));
    }

    public function create()
    {
        abort_if(Gate::denies('contract_type_rank_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contract_types = ContractType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.contractTypeRanks.create', compact('contract_types'));
    }

    public function store(StoreContractTypeRankRequest $request)
    {
        $contractTypeRank = ContractTypeRank::create($request->all());

        return redirect()->route('admin.contract-type-ranks.index');
    }

    public function edit(ContractTypeRank $contractTypeRank)
    {
        abort_if(Gate::denies('contract_type_rank_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contract_types = ContractType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contractTypeRank->load('contract_type');

        return view('admin.contractTypeRanks.edit', compact('contractTypeRank', 'contract_types'));
    }

    public function update(UpdateContractTypeRankRequest $request, ContractTypeRank $contractTypeRank)
    {
        $contractTypeRank->update($request->all());

        return redirect()->route('admin.contract-type-ranks.index');
    }

    public function show(ContractTypeRank $contractTypeRank)
    {
        abort_if(Gate::denies('contract_type_rank_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contractTypeRank->load('contract_type');

        return view('admin.contractTypeRanks.show', compact('contractTypeRank'));
    }

    public function destroy(ContractTypeRank $contractTypeRank)
    {
        abort_if(Gate::denies('contract_type_rank_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contractTypeRank->delete();

        return back();
    }

    public function massDestroy(MassDestroyContractTypeRankRequest $request)
    {
        $contractTypeRanks = ContractTypeRank::find(request('ids'));

        foreach ($contractTypeRanks as $contractTypeRank) {
            $contractTypeRank->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
