<?php

namespace App\Http\Requests;

use App\Models\ProductForm;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductFormRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_form_create');
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
            'city' => [
                'string',
                'nullable',
            ],
            'rgpd' => [
                'required',
            ],
            'product_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
