<?php

namespace App\Http\Requests;

use App\Models\Driver;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDriverRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('driver_edit');
    }

    public function rules()
    {
        return [
            'code' => [
                'string',
                'required',
            ],
            'name' => [
                'string',
                'required',
            ],
            'contract_type_id' => [
                'required',
                'integer',
            ],
            'contract_vat_id' => [
                'required',
                'integer',
            ],
            'start_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'end_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'reason' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'payment_vat' => [
                'string',
                'nullable',
            ],
            'citizen_card' => [
                'string',
                'nullable',
            ],
            'iban' => [
                'string',
                'nullable',
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'zip' => [
                'string',
                'nullable',
            ],
            'city' => [
                'string',
                'nullable',
            ],
            'state_id' => [
                'required',
                'integer',
            ],
            'driver_license' => [
                'string',
                'nullable',
            ],
            'driver_vat' => [
                'string',
                'nullable',
            ],
            'uber_uuid' => [
                'string',
                'nullable',
            ],
            'bolt_name' => [
                'string',
                'nullable',
            ],
            'license_plate' => [
                'string',
                'nullable',
            ],
            'brand' => [
                'string',
                'nullable',
            ],
            'model' => [
                'string',
                'nullable',
            ],
        ];
    }
}
