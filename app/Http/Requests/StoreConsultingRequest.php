<?php

namespace App\Http\Requests;

use App\Models\Consulting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreConsultingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('consulting_create');
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
