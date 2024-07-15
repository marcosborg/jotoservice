<?php

namespace App\Http\Requests;

use App\Models\CarRentalContactRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCarRentalContactRequestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('car_rental_contact_request_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'phone' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
            ],
            'city' => [
                'string',
                'required',
            ],
            'tvde_card' => [
                'string',
                'nullable',
            ],
            'car_id' => [
                'required',
                'integer',
            ],
            'message' => [
                'required',
            ],
            'rgpd' => [
                'required',
            ],
        ];
    }
}
