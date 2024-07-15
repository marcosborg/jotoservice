<?php

namespace App\Http\Requests;

use App\Models\Origin;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOriginRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('origin_edit');
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
