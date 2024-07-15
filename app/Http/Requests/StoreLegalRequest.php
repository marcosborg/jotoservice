<?php

namespace App\Http\Requests;

use App\Models\Legal;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLegalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('legal_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
        ];
    }
}
