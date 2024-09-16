<?php

namespace App\Http\Requests;

use App\Models\TollPayment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTollPaymentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('toll_payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:toll_payments,id',
        ];
    }
}