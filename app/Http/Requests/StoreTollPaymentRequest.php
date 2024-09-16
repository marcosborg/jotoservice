<?php

namespace App\Http\Requests;

use App\Models\TollPayment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTollPaymentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('toll_payment_create');
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