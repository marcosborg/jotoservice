<?php

namespace App\Http\Requests;

use App\Models\CourierForm;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCourierFormRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('courier_form_edit');
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
            'city' => [
                'string',
                'nullable',
            ],
            'account' => [
                'string',
                'nullable',
            ],
            'rgpd' => [
                'required',
            ],
        ];
    }
}
