<?php

namespace App\Http\Requests;

use App\Models\StandCar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStandCarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('stand_car_edit');
    }

    public function rules()
    {
        return [
            'brand_id' => [
                'required',
                'integer',
            ],
            'car_model_id' => [
                'required',
                'integer',
            ],
            'fuel_id' => [
                'required',
                'integer',
            ],
            'transmision' => [
                'required',
            ],
            'cylinder_capacity' => [
                'numeric',
            ],
            'battery_capacity' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'year' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'month_id' => [
                'required',
                'integer',
            ],
            'kilometers' => [
                'string',
                'required',
            ],
            'power' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'origin_id' => [
                'required',
                'integer',
            ],
            'distance' => [
                'string',
                'required',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
            'images' => [
                'array',
            ],
        ];
    }
}