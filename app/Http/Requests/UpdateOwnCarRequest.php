<?php

namespace App\Http\Requests;

use App\Models\OwnCar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOwnCarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('own_car_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
