<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTransferTourRequest;
use App\Http\Requests\StoreTransferTourRequest;
use App\Http\Requests\UpdateTransferTourRequest;
use App\Models\TransferTour;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TransferTourController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('transfer_tour_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transferTours = TransferTour::with(['media'])->get();

        return view('admin.transferTours.index', compact('transferTours'));
    }

    public function create()
    {
        abort_if(Gate::denies('transfer_tour_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.transferTours.create');
    }

    public function store(StoreTransferTourRequest $request)
    {
        $transferTour = TransferTour::create($request->all());

        foreach ($request->input('photo', []) as $file) {
            $transferTour->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $transferTour->id]);
        }

        return redirect()->route('admin.transfer-tours.index');
    }

    public function edit(TransferTour $transferTour)
    {
        abort_if(Gate::denies('transfer_tour_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.transferTours.edit', compact('transferTour'));
    }

    public function update(UpdateTransferTourRequest $request, TransferTour $transferTour)
    {
        $transferTour->update($request->all());

        if (count($transferTour->photo) > 0) {
            foreach ($transferTour->photo as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }
        $media = $transferTour->photo->pluck('file_name')->toArray();
        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $transferTour->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo');
            }
        }

        return redirect()->route('admin.transfer-tours.index');
    }

    public function show(TransferTour $transferTour)
    {
        abort_if(Gate::denies('transfer_tour_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.transferTours.show', compact('transferTour'));
    }

    public function destroy(TransferTour $transferTour)
    {
        abort_if(Gate::denies('transfer_tour_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transferTour->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransferTourRequest $request)
    {
        TransferTour::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('transfer_tour_create') && Gate::denies('transfer_tour_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TransferTour();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
