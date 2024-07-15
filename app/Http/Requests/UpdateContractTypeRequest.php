<?php

namespace App\Http\Requests;

use App\Models\ContractType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateContractTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contract_type_edit');
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
