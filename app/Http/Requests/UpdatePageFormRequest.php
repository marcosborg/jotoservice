<?php

namespace App\Http\Requests;

use App\Models\PageForm;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePageFormRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('page_form_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'phone' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
            ],
            'rgpd' => [
                'required',
            ],
        ];
    }
}
