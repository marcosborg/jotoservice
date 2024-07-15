<?php

namespace App\Http\Requests;

use App\Models\ContractType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyContractTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('contract_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:contract_types,id',
        ];
    }
}
