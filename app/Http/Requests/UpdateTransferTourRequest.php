<?php

namespace App\Http\Requests;

use App\Models\TransferTour;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTransferTourRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transfer_tour_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'price' => [
                'required',
            ],
            'photo' => [
                'array',
            ],
        ];
    }
}
