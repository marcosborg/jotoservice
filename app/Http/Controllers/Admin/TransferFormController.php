<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransferFormRequest;
use App\Http\Requests\StoreTransferFormRequest;
use App\Http\Requests\UpdateTransferFormRequest;
use App\Models\TransferForm;
use App\Models\TransferTour;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransferFormController extends Controller
{
    public function index()
    {

        abort_if(Gate::denies('transfer_form_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transferForms = TransferForm::with(['transfer_tour'])->get();

        return view('admin.transferForms.index', compact('transferForms'));
    }

    public function create()
    {
        abort_if(Gate::denies('transfer_form_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transfer_tours = TransferTour::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.transferForms.create', compact('transfer_tours'));
    }

    public function store(StoreTransferFormRequest $request)
    {
        $transferForm = TransferForm::create($request->all());

        return redirect()->route('admin.transfer-forms.index');
    }

    public function edit(TransferForm $transferForm)
    {
        abort_if(Gate::denies('transfer_form_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transfer_tours = TransferTour::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transferForm->load('transfer_tour');

        return view('admin.transferForms.edit', compact('transferForm', 'transfer_tours'));
    }

    public function update(UpdateTransferFormRequest $request, TransferForm $transferForm)
    {
        $transferForm->update($request->all());

        return redirect()->route('admin.transfer-forms.index');
    }

    public function show(TransferForm $transferForm)
    {
        abort_if(Gate::denies('transfer_form_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transferForm->load('transfer_tour');

        return view('admin.transferForms.show', compact('transferForm'));
    }

    public function destroy(TransferForm $transferForm)
    {
        abort_if(Gate::denies('transfer_form_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transferForm->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransferFormRequest $request)
    {
        TransferForm::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
