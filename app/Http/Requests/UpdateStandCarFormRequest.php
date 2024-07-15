<?php

namespace App\Http\Requests;

use App\Models\StandCarForm;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStandCarFormRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('stand_car_form_edit');
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