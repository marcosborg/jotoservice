<?php

namespace App\Http\Requests;

use App\Models\VehicleItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyVehicleItemRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('vehicle_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:vehicle_items,id',
        ];
    }
}
