<?php

namespace App\Http\Requests;

use App\Models\TransferForm;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTransferFormRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('transfer_form_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:transfer_forms,id',
        ];
    }
}
