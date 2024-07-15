<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyHomeInfoRequest;
use App\Http\Requests\StoreHomeInfoRequest;
use App\Http\Requests\UpdateHomeInfoRequest;
use App\Models\HomeInfo;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class HomeInfoController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('home_info_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $homeInfos = HomeInfo::with(['media'])->get();

        return view('admin.homeInfos.index', compact('homeInfos'));
    }

    public function create()
    {
        abort_if(Gate::denies('home_info_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.homeInfos.create');
    }

    public function store(StoreHomeInfoRequest $request)
    {
        $homeInfo = HomeInfo::create($request->all());

        if ($request->input('image', false)) {
            $homeInfo->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $homeInfo->id]);
        }

        return redirect()->route('admin.home-infos.index');
    }

    public function edit(HomeInfo $homeInfo)
    {
        abort_if(Gate::denies('home_info_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.homeInfos.edit', compact('homeInfo'));
    }

    public function update(UpdateHomeInfoRequest $request, HomeInfo $homeInfo)
    {
        $homeInfo->update($request->all());

        if ($request->input('image', false)) {
            if (!$homeInfo->image || $request->input('image') !== $homeInfo->image->file_name) {
                if ($homeInfo->image) {
                    $homeInfo->image->delete();
                }
                $homeInfo->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($homeInfo->image) {
            $homeInfo->image->delete();
        }

        return redirect("admin/home-infos/1/edit")->with('status', 'Atualizado com sucesso');
    }

    public function show(HomeInfo $homeInfo)
    {
        abort_if(Gate::denies('home_info_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.homeInfos.show', compact('homeInfo'));
    }

    public function destroy(HomeInfo $homeInfo)
    {
        abort_if(Gate::denies('home_info_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $homeInfo->delete();

        return back();
    }

    public function massDestroy(MassDestroyHomeInfoRequest $request)
    {
        HomeInfo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('home_info_create') && Gate::denies('home_info_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new HomeInfo();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
