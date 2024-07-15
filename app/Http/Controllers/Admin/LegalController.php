<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyLegalRequest;
use App\Http\Requests\StoreLegalRequest;
use App\Http\Requests\UpdateLegalRequest;
use App\Models\Legal;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class LegalController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('legal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $legals = Legal::all();

        return view('admin.legals.index', compact('legals'));
    }

    public function create()
    {
        abort_if(Gate::denies('legal_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.legals.create');
    }

    public function store(StoreLegalRequest $request)
    {
        $legal = Legal::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $legal->id]);
        }

        return redirect()->route('admin.legals.index');
    }

    public function edit(Legal $legal)
    {
        abort_if(Gate::denies('legal_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.legals.edit', compact('legal'));
    }

    public function update(UpdateLegalRequest $request, Legal $legal)
    {
        $legal->update($request->all());

        return redirect()->route('admin.legals.index');
    }

    public function show(Legal $legal)
    {
        abort_if(Gate::denies('legal_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.legals.show', compact('legal'));
    }

    public function destroy(Legal $legal)
    {
        abort_if(Gate::denies('legal_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $legal->delete();

        return back();
    }

    public function massDestroy(MassDestroyLegalRequest $request)
    {
        Legal::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('legal_create') && Gate::denies('legal_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Legal();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
