<?php

namespace App\Http\Requests;

use App\Models\TollPayment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTollPaymentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('toll_payment_edit');
    }

    public function rules()
    {
        return [
            'tvde_week_id' => [
                'required',
                'integer',
            ],
            'card' => [
                'string',
                'required',
            ],
            'total' => [
                'required',
            ],
        ];
    }
}