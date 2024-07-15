<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOwnCarFormRequest;
use App\Http\Requests\StoreOwnCarFormRequest;
use App\Http\Requests\UpdateOwnCarFormRequest;
use App\Models\OwnCarForm;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OwnCarFormController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('own_car_form_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ownCarForms = OwnCarForm::all();

        return view('admin.ownCarForms.index', compact('ownCarForms'));
    }

    public function create()
    {
        abort_if(Gate::denies('own_car_form_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ownCarForms.create');
    }

    public function store(StoreOwnCarFormRequest $request)
    {
        $ownCarForm = OwnCarForm::create($request->all());

        return redirect()->route('admin.own-car-forms.index');
    }

    public function edit(OwnCarForm $ownCarForm)
    {
        abort_if(Gate::denies('own_car_form_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ownCarForms.edit', compact('ownCarForm'));
    }

    public function update(UpdateOwnCarFormRequest $request, OwnCarForm $ownCarForm)
    {
        $ownCarForm->update($request->all());

        return redirect()->route('admin.own-car-forms.index');
    }

    public function show(OwnCarForm $ownCarForm)
    {
        abort_if(Gate::denies('own_car_form_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ownCarForms.show', compact('ownCarForm'));
    }

    public function destroy(OwnCarForm $ownCarForm)
    {
        abort_if(Gate::denies('own_car_form_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ownCarForm->delete();

        return back();
    }

    public function massDestroy(MassDestroyOwnCarFormRequest $request)
    {
        OwnCarForm::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
