<?php

namespace App\Http\Requests;

use App\Models\OwnCar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOwnCarRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('own_car_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:own_cars,id',
        ];
    }
}
