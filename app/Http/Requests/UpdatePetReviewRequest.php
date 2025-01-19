<?php

namespace App\Http\Requests;

use App\Models\PetReview;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePetReviewRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pet_review_edit');
    }

    public function rules()
    {
        return [
            'pet_id' => [
                'required',
                'integer',
            ],
            'score' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'submitted_by_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
