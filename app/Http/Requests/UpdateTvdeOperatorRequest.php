<?php

namespace App\Http\Requests;

use App\Models\TvdeOperator;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTvdeOperatorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tvde_operator_edit');
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
