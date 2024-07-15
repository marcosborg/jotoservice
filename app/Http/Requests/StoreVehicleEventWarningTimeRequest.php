<?php

namespace App\Http\Requests;

use App\Models\VehicleEventWarningTime;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVehicleEventWarningTimeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vehicle_event_warning_time_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'days' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
