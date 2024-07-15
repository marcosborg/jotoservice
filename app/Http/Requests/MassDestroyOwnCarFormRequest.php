<?php

namespace App\Http\Requests;

use App\Models\OwnCarForm;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOwnCarFormRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('own_car_form_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:own_car_forms,id',
        ];
    }
}
