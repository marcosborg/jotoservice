<?php

namespace App\Http\Requests;

use App\Models\ElectricTransaction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateElectricTransactionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('electric_transaction_edit');
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
            'amount' => [
                'numeric',
                'required',
            ],
            'total' => [
                'required',
            ],
        ];
    }
}
