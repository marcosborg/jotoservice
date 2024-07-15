<?php

namespace App\Http\Requests;

use App\Models\ContractVat;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateContractVatRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contract_vat_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'percent' => [
                'numeric',
                'required',
            ],
            'tips' => [
                'numeric',
                'required',
            ],
            'contract_type_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
