<?php

namespace App\Http\Requests;

use App\Models\TvdeMonth;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTvdeMonthRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tvde_month_edit');
    }

    public function rules()
    {
        return [
            'year_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'number' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
