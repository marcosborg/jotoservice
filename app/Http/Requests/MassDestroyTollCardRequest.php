<?php

namespace App\Http\Requests;

use App\Models\TollCard;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTollCardRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('toll_card_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:toll_cards,id',
        ];
    }
}