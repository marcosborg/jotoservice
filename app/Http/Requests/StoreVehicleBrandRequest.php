<?php

namespace App\Http\Requests;

use App\Models\VehicleBrand;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVehicleBrandRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vehicle_brand_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
