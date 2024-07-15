<?php

namespace App\Http\Requests;

use App\Models\TvdeWeek;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTvdeWeekRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tvde_week_create');
    }

    public function rules()
    {
        return [
            'tvde_month_id' => [
                'required',
                'integer',
            ],
            'number' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'start_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'end_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}