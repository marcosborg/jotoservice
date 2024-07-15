<?php

namespace App\Http\Requests;

use App\Models\CarRentalContactRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCarRentalContactRequestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('car_rental_contact_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:car_rental_contact_requests,id',
        ];
    }
}
