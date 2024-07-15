<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyConsultingFormRequest;
use App\Http\Requests\StoreConsultingFormRequest;
use App\Http\Requests\UpdateConsultingFormRequest;
use App\Models\ConsultingForm;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConsultingFormController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('consulting_form_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consultingForms = ConsultingForm::all();

        return view('admin.consultingForms.index', compact('consultingForms'));
    }

    public function create()
    {
        abort_if(Gate::denies('consulting_form_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.consultingForms.create');
    }

    public function store(StoreConsultingFormRequest $request)
    {
        $consultingForm = ConsultingForm::create($request->all());

        return redirect()->route('admin.consulting-forms.index');
    }

    public function edit(ConsultingForm $consultingForm)
    {
        abort_if(Gate::denies('consulting_form_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.consultingForms.edit', compact('consultingForm'));
    }

    public function update(UpdateConsultingFormRequest $request, ConsultingForm $consultingForm)
    {
        $consultingForm->update($request->all());

        return redirect()->route('admin.consulting-forms.index');
    }

    public function show(ConsultingForm $consultingForm)
    {
        abort_if(Gate::denies('consulting_form_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.consultingForms.show', compact('consultingForm'));
    }

    public function destroy(ConsultingForm $consultingForm)
    {
        abort_if(Gate::denies('consulting_form_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consultingForm->delete();

        return back();
    }

    public function massDestroy(MassDestroyConsultingFormRequest $request)
    {
        ConsultingForm::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
