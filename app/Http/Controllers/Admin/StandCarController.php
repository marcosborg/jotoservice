<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyStandCarRequest;
use App\Http\Requests\StoreStandCarRequest;
use App\Http\Requests\UpdateStandCarRequest;
use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Fuel;
use App\Models\Month;
use App\Models\Origin;
use App\Models\StandCar;
use App\Models\Status;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StandCarController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('stand_car_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StandCar::with(['brand', 'car_model', 'fuel', 'month', 'origin', 'status'])->select(sprintf('%s.*', (new StandCar())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'stand_car_show';
                $editGate = 'stand_car_edit';
                $deleteGate = 'stand_car_delete';
                $crudRoutePart = 'stand-cars';

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
            $table->addColumn('brand_name', function ($row) {
                return $row->brand ? $row->brand->name : '';
            });

            $table->addColumn('car_model_name', function ($row) {
                return $row->car_model ? $row->car_model->name : '';
            });

            $table->addColumn('fuel_name', function ($row) {
                return $row->fuel ? $row->fuel->name : '';
            });

            $table->editColumn('transmision', function ($row) {
                return $row->transmision ? StandCar::TRANSMISION_RADIO[$row->transmision] : '';
            });
            $table->editColumn('cylinder_capacity', function ($row) {
                return $row->cylinder_capacity ? $row->cylinder_capacity : '';
            });
            $table->editColumn('battery_capacity', function ($row) {
                return $row->battery_capacity ? $row->battery_capacity : '';
            });
            $table->editColumn('year', function ($row) {
                return $row->year ? $row->year : '';
            });
            $table->addColumn('month_name', function ($row) {
                return $row->month ? $row->month->name : '';
            });

            $table->editColumn('kilometers', function ($row) {
                return $row->kilometers ? $row->kilometers : '';
            });
            $table->editColumn('power', function ($row) {
                return $row->power ? $row->power : '';
            });
            $table->addColumn('origin_name', function ($row) {
                return $row->origin ? $row->origin->name : '';
            });

            $table->editColumn('distance', function ($row) {
                return $row->distance ? $row->distance : '';
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->editColumn('images', function ($row) {
                if (!$row->images) {
                    return '';
                }
                $links = [];
                foreach ($row->images as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'brand', 'car_model', 'fuel', 'month', 'origin', 'status', 'images']);

            return $table->make(true);
        }

        return view('admin.standCars.index');
    }

    public function create()
    {
        abort_if(Gate::denies('stand_car_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brands = Brand::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $car_models = CarModel::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $fuels = Fuel::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $months = Month::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $origins = Origin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.standCars.create', compact('brands', 'car_models', 'fuels', 'months', 'origins', 'statuses'));
    }

    public function store(StoreStandCarRequest $request)
    {
        $standCar = StandCar::create($request->all());

        foreach ($request->input('images', []) as $file) {
            $standCar->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $standCar->id]);
        }

        return redirect()->route('admin.stand-cars.index');
    }

    public function edit(StandCar $standCar)
    {
        abort_if(Gate::denies('stand_car_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brands = Brand::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $car_models = CarModel::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $fuels = Fuel::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $months = Month::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $origins = Origin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $standCar->load('brand', 'car_model', 'fuel', 'month', 'origin', 'status');

        return view('admin.standCars.edit', compact('brands', 'car_models', 'fuels', 'months', 'origins', 'standCar', 'statuses'));
    }

    public function update(UpdateStandCarRequest $request, StandCar $standCar)
    {
        $standCar->update($request->all());

        if (count($standCar->images) > 0) {
            foreach ($standCar->images as $media) {
                if (!in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }
        $media = $standCar->images->pluck('file_name')->toArray();
        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $standCar->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images');
            }
        }

        return redirect()->route('admin.stand-cars.index');
    }

    public function show(StandCar $standCar)
    {
        abort_if(Gate::denies('stand_car_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $standCar->load('brand', 'car_model', 'fuel', 'month', 'origin', 'status');

        return view('admin.standCars.show', compact('standCar'));
    }

    public function destroy(StandCar $standCar)
    {
        abort_if(Gate::denies('stand_car_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $standCar->delete();

        return back();
    }

    public function massDestroy(MassDestroyStandCarRequest $request)
    {
        StandCar::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('stand_car_create') && Gate::denies('stand_car_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new StandCar();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
