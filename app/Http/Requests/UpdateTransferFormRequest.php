<?php

namespace App\Http\Requests;

use App\Models\TransferForm;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTransferFormRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transfer_form_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'phone' => [
                'string',
                'required',
            ],
            'city' => [
                'string',
                'nullable',
            ],
            'rgpd' => [
                'required',
            ],
            'transfer_tour_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
