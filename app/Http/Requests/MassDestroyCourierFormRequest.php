<?php

namespace App\Http\Requests;

use App\Models\CourierForm;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCourierFormRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('courier_form_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:courier_forms,id',
        ];
    }
}
