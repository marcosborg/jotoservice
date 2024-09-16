<?php

namespace App\Http\Requests;

use App\Models\TollCard;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTollCardRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('toll_card_create');
    }

    public function rules()
    {
        return [
            'code' => [
                'string',
                'required',
            ],
        ];
    }
}