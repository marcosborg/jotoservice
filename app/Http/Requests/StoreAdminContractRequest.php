<?php

namespace App\Http\Requests;

use App\Models\AdminContract;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAdminContractRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('admin_contract_create');
    }

    public function rules()
    {
        return [
            'number' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'driver_id' => [
                'required',
                'integer',
            ],
            'signed_at' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
