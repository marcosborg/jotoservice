<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTrainingFormRequest;
use App\Http\Requests\StoreTrainingFormRequest;
use App\Http\Requests\UpdateTrainingFormRequest;
use App\Models\TrainingForm;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrainingFormController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('training_form_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trainingForms = TrainingForm::all();

        return view('admin.trainingForms.index', compact('trainingForms'));
    }

    public function create()
    {
        abort_if(Gate::denies('training_form_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.trainingForms.create');
    }

    public function store(StoreTrainingFormRequest $request)
    {
        $trainingForm = TrainingForm::create($request->all());

        return redirect()->route('admin.training-forms.index');
    }

    public function edit(TrainingForm $trainingForm)
    {
        abort_if(Gate::denies('training_form_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.trainingForms.edit', compact('trainingForm'));
    }

    public function update(UpdateTrainingFormRequest $request, TrainingForm $trainingForm)
    {
        $trainingForm->update($request->all());

        return redirect()->route('admin.training-forms.index');
    }

    public function show(TrainingForm $trainingForm)
    {
        abort_if(Gate::denies('training_form_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.trainingForms.show', compact('trainingForm'));
    }

    public function destroy(TrainingForm $trainingForm)
    {
        abort_if(Gate::denies('training_form_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trainingForm->delete();

        return back();
    }

    public function massDestroy(MassDestroyTrainingFormRequest $request)
    {
        TrainingForm::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
