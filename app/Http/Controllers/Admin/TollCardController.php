<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTollCardRequest;
use App\Http\Requests\StoreTollCardRequest;
use App\Http\Requests\UpdateTollCardRequest;
use App\Models\Company;
use App\Models\TollCard;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TollCardController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('toll_card_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tollCards = TollCard::with(['company'])->get();

        return view('admin.tollCards.index', compact('tollCards'));
    }

    public function create()
    {
        abort_if(Gate::denies('toll_card_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tollCards.create', compact('companies'));
    }

    public function store(StoreTollCardRequest $request)
    {
        $tollCard = TollCard::create($request->all());

        return redirect()->route('admin.toll-cards.index');
    }

    public function edit(TollCard $tollCard)
    {
        abort_if(Gate::denies('toll_card_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tollCard->load('company');

        return view('admin.tollCards.edit', compact('companies', 'tollCard'));
    }

    public function update(UpdateTollCardRequest $request, TollCard $tollCard)
    {
        $tollCard->update($request->all());

        return redirect()->route('admin.toll-cards.index');
    }

    public function show(TollCard $tollCard)
    {
        abort_if(Gate::denies('toll_card_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tollCard->load('company');

        return view('admin.tollCards.show', compact('tollCard'));
    }

    public function destroy(TollCard $tollCard)
    {
        abort_if(Gate::denies('toll_card_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tollCard->delete();

        return back();
    }

    public function massDestroy(MassDestroyTollCardRequest $request)
    {
        $tollCards = TollCard::find(request('ids'));

        foreach ($tollCards as $tollCard) {
            $tollCard->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}