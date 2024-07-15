<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyOwnCarRequest;
use App\Http\Requests\StoreOwnCarRequest;
use App\Http\Requests\UpdateOwnCarRequest;
use App\Models\OwnCar;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class OwnCarController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('own_car_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ownCars = OwnCar::with(['media'])->get();

        return view('admin.ownCars.index', compact('ownCars'));
    }

    public function create()
    {
        abort_if(Gate::denies('own_car_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ownCars.create');
    }

    public function store(StoreOwnCarRequest $request)
    {
        $ownCar = OwnCar::create($request->all());

        if ($request->input('image', false)) {
            $ownCar->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $ownCar->id]);
        }

        return redirect()->route('admin.own-cars.index');
    }

    public function edit(OwnCar $ownCar)
    {
        abort_if(Gate::denies('own_car_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ownCars.edit', compact('ownCar'));
    }

    public function update(UpdateOwnCarRequest $request, OwnCar $ownCar)
    {
        $ownCar->update($request->all());

        if ($request->input('image', false)) {
            if (!$ownCar->image || $request->input('image') !== $ownCar->image->file_name) {
                if ($ownCar->image) {
                    $ownCar->image->delete();
                }
                $ownCar->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($ownCar->image) {
            $ownCar->image->delete();
        }

        return redirect('admin/own-cars/1/edit')->with('status', 'Atualizado com sucesso');
    }

    public function show(OwnCar $ownCar)
    {
        abort_if(Gate::denies('own_car_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ownCars.show', compact('ownCar'));
    }

    public function destroy(OwnCar $ownCar)
    {
        abort_if(Gate::denies('own_car_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ownCar->delete();

        return back();
    }

    public function massDestroy(MassDestroyOwnCarRequest $request)
    {
        OwnCar::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('own_car_create') && Gate::denies('own_car_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new OwnCar();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
