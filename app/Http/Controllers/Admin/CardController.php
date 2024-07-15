<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCardRequest;
use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Models\Card;
use App\Models\Company;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CardController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('card_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (!session()->get('company_id') || session()->get('company_id') == 0) {
            $cards = Card::with(['company'])->get();
        } else {
            $cards = Card::where('company_id', session()->get('company_id'))->with(['company'])->get();
        }

        return view('admin.cards.index', compact('cards'));
    }

    public function create()
    {
        abort_if(Gate::denies('card_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.cards.create', compact('companies'));
    }

    public function store(StoreCardRequest $request)
    {
        $card = Card::create($request->all());

        return redirect()->route('admin.cards.index');
    }

    public function edit(Card $card)
    {
        abort_if(Gate::denies('card_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $card->load('company');

        return view('admin.cards.edit', compact('card', 'companies'));
    }

    public function update(UpdateCardRequest $request, Card $card)
    {
        $card->update($request->all());

        return redirect()->route('admin.cards.index');
    }

    public function show(Card $card)
    {
        abort_if(Gate::denies('card_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $card->load('company');

        return view('admin.cards.show', compact('card'));
    }

    public function destroy(Card $card)
    {
        abort_if(Gate::denies('card_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $card->delete();

        return back();
    }

    public function massDestroy(MassDestroyCardRequest $request)
    {
        $cards = Card::find(request('ids'));

        foreach ($cards as $card) {
            $card->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}