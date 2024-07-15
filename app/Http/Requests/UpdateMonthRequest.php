<?php

namespace App\Http\Requests;

use App\Models\Month;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMonthRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('month_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
