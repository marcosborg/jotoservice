<?php

namespace App\Http\Requests;

use App\Models\Training;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTrainingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('training_edit');
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
