<?php

namespace App\Http\Requests;

use App\Models\VehicleEvent;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyVehicleEventRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('vehicle_event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:vehicle_events,id',
        ];
    }
}
