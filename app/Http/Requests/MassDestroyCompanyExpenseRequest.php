<?php

namespace App\Http\Requests;

use App\Models\CompanyExpense;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCompanyExpenseRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('company_expense_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:company_expenses,id',
        ];
    }
}
