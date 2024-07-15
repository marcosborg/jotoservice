<?php

namespace App\Http\Requests;

use App\Models\TvdeWeek;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTvdeWeekRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('tvde_week_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:tvde_weeks,id',
        ];
    }
}