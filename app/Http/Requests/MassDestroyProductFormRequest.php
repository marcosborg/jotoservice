<?php

namespace App\Http\Requests;

use App\Models\ProductForm;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProductFormRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('product_form_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:product_forms,id',
        ];
    }
}
