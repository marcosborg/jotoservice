<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOriginRequest;
use App\Http\Requests\StoreOriginRequest;
use App\Http\Requests\UpdateOriginRequest;
use App\Models\Origin;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OriginController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('origin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $origins = Origin::all();

        return view('admin.origins.index', compact('origins'));
    }

    public function create()
    {
        abort_if(Gate::denies('origin_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.origins.create');
    }

    public function store(StoreOriginRequest $request)
    {
        $origin = Origin::create($request->all());

        return redirect()->route('admin.origins.index');
    }

    public function edit(Origin $origin)
    {
        abort_if(Gate::denies('origin_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.origins.edit', compact('origin'));
    }

    public function update(UpdateOriginRequest $request, Origin $origin)
    {
        $origin->update($request->all());

        return redirect()->route('admin.origins.index');
    }

    public function show(Origin $origin)
    {
        abort_if(Gate::denies('origin_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.origins.show', compact('origin'));
    }

    public function destroy(Origin $origin)
    {
        abort_if(Gate::denies('origin_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $origin->delete();

        return back();
    }

    public function massDestroy(MassDestroyOriginRequest $request)
    {
        Origin::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
