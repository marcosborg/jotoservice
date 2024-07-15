<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyHeroBannerRequest;
use App\Http\Requests\StoreHeroBannerRequest;
use App\Http\Requests\UpdateHeroBannerRequest;
use App\Models\HeroBanner;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class HeroBannerController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('hero_banner_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $heroBanners = HeroBanner::with(['media'])->get();

        return view('admin.heroBanners.index', compact('heroBanners'));
    }

    public function create()
    {
        abort_if(Gate::denies('hero_banner_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.heroBanners.create');
    }

    public function store(StoreHeroBannerRequest $request)
    {
        $heroBanner = HeroBanner::create($request->all());

        if ($request->input('image', false)) {
            $heroBanner->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $heroBanner->id]);
        }

        return redirect()->route('admin.hero-banners.index');
    }

    public function edit(HeroBanner $heroBanner)
    {
        abort_if(Gate::denies('hero_banner_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.heroBanners.edit', compact('heroBanner'));
    }

    public function update(UpdateHeroBannerRequest $request, HeroBanner $heroBanner)
    {
        $heroBanner->update($request->all());

        if ($request->input('image', false)) {
            if (!$heroBanner->image || $request->input('image') !== $heroBanner->image->file_name) {
                if ($heroBanner->image) {
                    $heroBanner->image->delete();
                }
                $heroBanner->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($heroBanner->image) {
            $heroBanner->image->delete();
        }

        return redirect("admin/hero-banners/1/edit")->with('status', 'Atualizado com sucesso');
    }

    public function show(HeroBanner $heroBanner)
    {
        abort_if(Gate::denies('hero_banner_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.heroBanners.show', compact('heroBanner'));
    }

    public function destroy(HeroBanner $heroBanner)
    {
        abort_if(Gate::denies('hero_banner_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $heroBanner->delete();

        return back();
    }

    public function massDestroy(MassDestroyHeroBannerRequest $request)
    {
        HeroBanner::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('hero_banner_create') && Gate::denies('hero_banner_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new HeroBanner();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
