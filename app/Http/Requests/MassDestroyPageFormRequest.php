<?php

namespace App\Http\Requests;

use App\Models\PageForm;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPageFormRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('page_form_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:page_forms,id',
        ];
    }
}
