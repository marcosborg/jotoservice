<?php

namespace App\Http\Requests;

use App\Models\VehicleEventType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVehicleEventTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vehicle_event_type_create');
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
