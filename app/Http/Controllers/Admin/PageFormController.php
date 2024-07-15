<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPageFormRequest;
use App\Http\Requests\StorePageFormRequest;
use App\Http\Requests\UpdatePageFormRequest;
use App\Models\PageForm;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PageFormController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('page_form_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pageForms = PageForm::all();

        return view('admin.pageForms.index', compact('pageForms'));
    }

    public function create()
    {
        abort_if(Gate::denies('page_form_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pageForms.create');
    }

    public function store(StorePageFormRequest $request)
    {
        $pageForm = PageForm::create($request->all());

        return redirect()->route('admin.page-forms.index');
    }

    public function edit(PageForm $pageForm)
    {
        abort_if(Gate::denies('page_form_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pageForms.edit', compact('pageForm'));
    }

    public function update(UpdatePageFormRequest $request, PageForm $pageForm)
    {
        $pageForm->update($request->all());

        return redirect()->route('admin.page-forms.index');
    }

    public function show(PageForm $pageForm)
    {
        abort_if(Gate::denies('page_form_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pageForms.show', compact('pageForm'));
    }

    public function destroy(PageForm $pageForm)
    {
        abort_if(Gate::denies('page_form_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pageForm->delete();

        return back();
    }

    public function massDestroy(MassDestroyPageFormRequest $request)
    {
        PageForm::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
