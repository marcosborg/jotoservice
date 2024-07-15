<?php

namespace App\Http\Requests;

use App\Models\Courier;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCourierRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('courier_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:couriers,id',
        ];
    }
}
