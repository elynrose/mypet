<?php

namespace App\Http\Requests;

use App\Models\MemberReview;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMemberReviewRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('member_review_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
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
