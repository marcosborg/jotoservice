<?php

namespace App\Http\Requests;

use App\Models\Origin;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOriginRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('origin_create');
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
