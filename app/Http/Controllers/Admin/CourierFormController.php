<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCourierFormRequest;
use App\Http\Requests\StoreCourierFormRequest;
use App\Http\Requests\UpdateCourierFormRequest;
use App\Models\CourierForm;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourierFormController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('courier_form_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courierForms = CourierForm::all();

        return view('admin.courierForms.index', compact('courierForms'));
    }

    public function create()
    {
        abort_if(Gate::denies('courier_form_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.courierForms.create');
    }

    public function store(StoreCourierFormRequest $request)
    {
        $courierForm = CourierForm::create($request->all());

        return redirect()->route('admin.courier-forms.index');
    }

    public function edit(CourierForm $courierForm)
    {
        abort_if(Gate::denies('courier_form_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.courierForms.edit', compact('courierForm'));
    }

    public function update(UpdateCourierFormRequest $request, CourierForm $courierForm)
    {
        $courierForm->update($request->all());

        return redirect()->route('admin.courier-forms.index');
    }

    public function show(CourierForm $courierForm)
    {
        abort_if(Gate::denies('courier_form_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.courierForms.show', compact('courierForm'));
    }

    public function destroy(CourierForm $courierForm)
    {
        abort_if(Gate::denies('courier_form_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courierForm->delete();

        return back();
    }

    public function massDestroy(MassDestroyCourierFormRequest $request)
    {
        CourierForm::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
