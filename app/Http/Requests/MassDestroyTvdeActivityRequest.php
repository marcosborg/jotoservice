<?php

namespace App\Http\Requests;

use App\Models\TvdeActivity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTvdeActivityRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('tvde_activity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:tvde_activities,id',
        ];
    }
}
