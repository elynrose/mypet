<?php

namespace App\Http\Requests;

use App\Models\NewRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreNewRequestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('new_request_create');
    }

    public function rules()
    {
        return [
            'pet_id' => [
                'required',
                'integer',
            ],
            'available_from' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'available_to' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
     
        ];
    }
}
