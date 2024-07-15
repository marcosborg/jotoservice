<?php

namespace App\Http\Requests;

use App\Models\OwnCarForm;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOwnCarFormRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('own_car_form_create');
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
                'nullable',
            ],
            'tvde_card' => [
                'string',
                'nullable',
            ],
            'rgpd' => [
                'required',
            ],
        ];
    }
}
