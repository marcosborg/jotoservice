<?php

namespace App\Http\Requests;

use App\Models\ConsultingForm;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyConsultingFormRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('consulting_form_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:consulting_forms,id',
        ];
    }
}
