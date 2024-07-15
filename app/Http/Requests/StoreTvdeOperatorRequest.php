<?php

namespace App\Http\Requests;

use App\Models\TvdeOperator;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTvdeOperatorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tvde_operator_create');
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
