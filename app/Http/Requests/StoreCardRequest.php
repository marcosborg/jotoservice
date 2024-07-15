<?php

namespace App\Http\Requests;

use App\Models\Card;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCardRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('card_create');
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
