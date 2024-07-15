<?php

namespace App\Http\Requests;

use App\Models\Consulting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyConsultingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('consulting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:consultings,id',
        ];
    }
}
