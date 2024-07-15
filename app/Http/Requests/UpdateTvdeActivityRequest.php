<?php

namespace App\Http\Requests;

use App\Models\TvdeActivity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTvdeActivityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tvde_activity_edit');
    }

    public function rules()
    {
        return [
            'tvde_week_id' => [
                'required',
                'integer',
            ],
            'tvde_operator_id' => [
                'required',
                'integer',
            ],
            'company_id' => [
                'required',
                'integer',
            ],
            'driver_code' => [
                'string',
                'required',
            ],
        ];
    }
}
