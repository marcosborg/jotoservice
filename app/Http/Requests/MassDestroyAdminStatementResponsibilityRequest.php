<?php

namespace App\Http\Requests;

use App\Models\AdminStatementResponsibility;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAdminStatementResponsibilityRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('admin_statement_responsibility_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:admin_statement_responsibilities,id',
        ];
    }
}
