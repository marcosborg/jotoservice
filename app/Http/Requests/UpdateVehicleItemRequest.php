<?php

namespace App\Http\Requests;

use App\Models\VehicleItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVehicleItemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vehicle_item_edit');
    }

    public function rules()
    {
        return [
            'vehicle_brand_id' => [
                'required',
                'integer',
            ],
            'vehicle_model_id' => [
                'required',
                'integer',
            ],
            'year' => [
                'string',
                'required',
            ],
            'license_plate' => [
                'string',
                'required',
            ],
            'documents' => [
                'array',
            ],
        ];
    }
}
