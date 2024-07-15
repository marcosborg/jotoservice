<?php

namespace App\Http\Requests;

use App\Models\Courier;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCourierRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('courier_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
