<?php

namespace App\Http\Requests;

use App\Models\Electric;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateElectricRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('electric_edit');
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
