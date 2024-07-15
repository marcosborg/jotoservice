<?php

namespace App\Http\Requests;

use App\Models\StandCarForm;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyStandCarFormRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('stand_car_form_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:stand_car_forms,id',
        ];
    }
}