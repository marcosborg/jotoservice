<?php

namespace App\Http\Requests;

use App\Models\CombustionTransaction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCombustionTransactionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('combustion_transaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:combustion_transactions,id',
        ];
    }
}
