<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyReceiptRequest;
use App\Http\Requests\StoreReceiptRequest;
use App\Http\Requests\UpdateReceiptRequest;
use App\Models\Driver;
use App\Models\Receipt;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReceiptController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('receipt_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Receipt::with(['driver'])->select(sprintf('%s.*', (new Receipt)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'receipt_show';
                $editGate      = 'receipt_edit';
                $deleteGate    = 'receipt_delete';
                $crudRoutePart = 'receipts';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('driver_name', function ($row) {
                return $row->driver ? $row->driver->name : '';
            });

            $table->editColumn('driver.code', function ($row) {
                return $row->driver ? (is_string($row->driver) ? $row->driver : $row->driver->code) : '';
            });
            $table->editColumn('value', function ($row) {
                return $row->value ? $row->value : '';
            });
            $table->editColumn('file', function ($row) {
                return $row->file ? '<a href="' . $row->file->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('paid', function ($row) {
                return '<input id="check-' . $row->id . '" onclick="checkPay(' . $row->id . ')" type="checkbox" ' . ($row->paid ? 'disabled' : '') . ' ' . ($row->paid ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'driver', 'file', 'paid']);

            return $table->make(true);
        }

        $drivers = Driver::get();

        return view('admin.receipts.index', compact('drivers'));
    }

    public function create()
    {
        abort_if(Gate::denies('receipt_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drivers = Driver::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.receipts.create', compact('drivers'));
    }

    public function store(StoreReceiptRequest $request)
    {
        $receipt = Receipt::create($request->all());

        if ($request->input('file', false)) {
            $receipt->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $receipt->id]);
        }

        return redirect()->route('admin.receipts.index');
    }

    public function edit(Receipt $receipt)
    {
        abort_if(Gate::denies('receipt_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drivers = Driver::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $receipt->load('driver');

        return view('admin.receipts.edit', compact('drivers', 'receipt'));
    }

    public function update(UpdateReceiptRequest $request, Receipt $receipt)
    {
        $receipt->update($request->all());

        if ($request->input('file', false)) {
            if (! $receipt->file || $request->input('file') !== $receipt->file->file_name) {
                if ($receipt->file) {
                    $receipt->file->delete();
                }
                $receipt->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($receipt->file) {
            $receipt->file->delete();
        }

        return redirect()->route('admin.receipts.index');
    }

    public function show(Receipt $receipt)
    {
        abort_if(Gate::denies('receipt_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $receipt->load('driver');

        return view('admin.receipts.show', compact('receipt'));
    }

    public function destroy(Receipt $receipt)
    {
        abort_if(Gate::denies('receipt_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $receipt->delete();

        return back();
    }

    public function massDestroy(MassDestroyReceiptRequest $request)
    {
        $receipts = Receipt::find(request('ids'));

        foreach ($receipts as $receipt) {
            $receipt->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('receipt_create') && Gate::denies('receipt_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Receipt();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function checkPay(Request $request)
    {
        $receipt = Receipt::find($request->receipt_id);
        $receipt->paid = true;
        $receipt->save();

    }
}