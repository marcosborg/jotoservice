<?php

namespace App\Http\Requests;

use App\Models\AdminStatementResponsibility;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAdminStatementResponsibilityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('admin_statement_responsibility_create');
    }

    public function rules()
    {
        return [
            'contract_number' => [
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
