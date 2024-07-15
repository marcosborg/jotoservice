<?php

namespace App\Http\Requests;

use App\Models\CompanyDocument;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCompanyDocumentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('company_document_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'file' => [
                'array',
                'required',
            ],
            'file.*' => [
                'required',
            ],
        ];
    }
}
