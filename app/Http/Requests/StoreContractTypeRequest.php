<?php

namespace App\Http\Requests;

use App\Models\ContractType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreContractTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contract_type_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
