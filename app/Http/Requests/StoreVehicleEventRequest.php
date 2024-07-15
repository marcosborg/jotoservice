<?php

namespace App\Http\Requests;

use App\Models\VehicleEvent;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVehicleEventRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vehicle_event_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'vehicle_event_type_id' => [
                'required',
                'integer',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'vehicle_item_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
