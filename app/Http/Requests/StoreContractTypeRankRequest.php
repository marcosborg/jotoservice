<?php

namespace App\Http\Requests;

use App\Models\ContractTypeRank;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreContractTypeRankRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contract_type_rank_create');
    }

    public function rules()
    {
        return [
            'percent' => [
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
