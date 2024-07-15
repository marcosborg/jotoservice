<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCompanyDocumentRequest;
use App\Http\Requests\StoreCompanyDocumentRequest;
use App\Http\Requests\UpdateCompanyDocumentRequest;
use App\Models\CompanyDocument;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CompanyDocumentController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('company_document_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companyDocuments = CompanyDocument::with(['media'])->get();

        return view('admin.companyDocuments.index', compact('companyDocuments'));
    }

    public function create()
    {
        abort_if(Gate::denies('company_document_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.companyDocuments.create');
    }

    public function store(StoreCompanyDocumentRequest $request)
    {
        $companyDocument = CompanyDocument::create($request->all());

        foreach ($request->input('file', []) as $file) {
            $companyDocument->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $companyDocument->id]);
        }

        return redirect()->route('admin.company-documents.index');
    }

    public function edit(CompanyDocument $companyDocument)
    {
        abort_if(Gate::denies('company_document_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.companyDocuments.edit', compact('companyDocument'));
    }

    public function update(UpdateCompanyDocumentRequest $request, CompanyDocument $companyDocument)
    {
        $companyDocument->update($request->all());

        if (count($companyDocument->file) > 0) {
            foreach ($companyDocument->file as $media) {
                if (! in_array($media->file_name, $request->input('file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $companyDocument->file->pluck('file_name')->toArray();
        foreach ($request->input('file', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $companyDocument->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file');
            }
        }

        return redirect()->route('admin.company-documents.index');
    }

    public function show(CompanyDocument $companyDocument)
    {
        abort_if(Gate::denies('company_document_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.companyDocuments.show', compact('companyDocument'));
    }

    public function destroy(CompanyDocument $companyDocument)
    {
        abort_if(Gate::denies('company_document_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companyDocument->delete();

        return back();
    }

    public function massDestroy(MassDestroyCompanyDocumentRequest $request)
    {
        $companyDocuments = CompanyDocument::find(request('ids'));

        foreach ($companyDocuments as $companyDocument) {
            $companyDocument->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('company_document_create') && Gate::denies('company_document_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CompanyDocument();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
