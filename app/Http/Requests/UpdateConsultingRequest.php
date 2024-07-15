<?php

namespace App\Http\Requests;

use App\Models\Consulting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateConsultingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('consulting_edit');
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
