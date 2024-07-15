<?php

namespace App\Http\Requests;

use App\Models\Training;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTrainingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('training_create');
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
