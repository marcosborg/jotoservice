<?php

namespace App\Http\Requests;

use App\Models\ElectricTransaction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyElectricTransactionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('electric_transaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:electric_transactions,id',
        ];
    }
}
