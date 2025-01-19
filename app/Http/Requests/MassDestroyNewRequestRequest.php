<?php

namespace App\Http\Requests;

use App\Models\NewRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyNewRequestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('new_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:new_requests,id',
        ];
    }
}
