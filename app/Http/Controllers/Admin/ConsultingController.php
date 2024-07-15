<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyConsultingRequest;
use App\Http\Requests\StoreConsultingRequest;
use App\Http\Requests\UpdateConsultingRequest;
use App\Models\Consulting;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ConsultingController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('consulting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consultings = Consulting::with(['media'])->get();

        return view('admin.consultings.index', compact('consultings'));
    }

    public function create()
    {
        abort_if(Gate::denies('consulting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.consultings.create');
    }

    public function store(StoreConsultingRequest $request)
    {
        $consulting = Consulting::create($request->all());

        if ($request->input('image', false)) {
            $consulting->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $consulting->id]);
        }

        return redirect()->route('admin.consultings.index');
    }

    public function edit(Consulting $consulting)
    {
        abort_if(Gate::denies('consulting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.consultings.edit', compact('consulting'));
    }

    public function update(UpdateConsultingRequest $request, Consulting $consulting)
    {
        $consulting->update($request->all());

        if ($request->input('image', false)) {
            if (!$consulting->image || $request->input('image') !== $consulting->image->file_name) {
                if ($consulting->image) {
                    $consulting->image->delete();
                }
                $consulting->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($consulting->image) {
            $consulting->image->delete();
        }

        return redirect('admin/consultings/1/edit')->with('status', 'Atualizado com sucesso');
    }

    public function show(Consulting $consulting)
    {
        abort_if(Gate::denies('consulting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.consultings.show', compact('consulting'));
    }

    public function destroy(Consulting $consulting)
    {
        abort_if(Gate::denies('consulting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consulting->delete();

        return back();
    }

    public function massDestroy(MassDestroyConsultingRequest $request)
    {
        Consulting::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('consulting_create') && Gate::denies('consulting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Consulting();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
