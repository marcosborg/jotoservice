<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCourierRequest;
use App\Http\Requests\StoreCourierRequest;
use App\Http\Requests\UpdateCourierRequest;
use App\Models\Courier;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CourierController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('courier_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $couriers = Courier::with(['media'])->get();

        return view('admin.couriers.index', compact('couriers'));
    }

    public function create()
    {
        abort_if(Gate::denies('courier_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.couriers.create');
    }

    public function store(StoreCourierRequest $request)
    {
        $courier = Courier::create($request->all());

        if ($request->input('image', false)) {
            $courier->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $courier->id]);
        }

        return redirect()->route('admin.couriers.index');
    }

    public function edit(Courier $courier)
    {
        abort_if(Gate::denies('courier_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.couriers.edit', compact('courier'));
    }

    public function update(UpdateCourierRequest $request, Courier $courier)
    {
        $courier->update($request->all());

        if ($request->input('image', false)) {
            if (!$courier->image || $request->input('image') !== $courier->image->file_name) {
                if ($courier->image) {
                    $courier->image->delete();
                }
                $courier->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($courier->image) {
            $courier->image->delete();
        }

        return redirect('admin/couriers/1/edit')->with('status', 'Atualizado com sucesso');
    }

    public function show(Courier $courier)
    {
        abort_if(Gate::denies('courier_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.couriers.show', compact('courier'));
    }

    public function destroy(Courier $courier)
    {
        abort_if(Gate::denies('courier_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courier->delete();

        return back();
    }

    public function massDestroy(MassDestroyCourierRequest $request)
    {
        Courier::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('courier_create') && Gate::denies('courier_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Courier();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
