<?php

namespace App\Http\Requests;

use App\Models\Electric;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreElectricRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('electric_create');
    }

    public function rules()
    {
        return [
            'code' => [
                'string',
                'required',
            ],
        ];
    }
}
