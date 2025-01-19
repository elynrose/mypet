<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMemberReviewRequest;
use App\Http\Requests\StoreMemberReviewRequest;
use App\Http\Requests\UpdateMemberReviewRequest;
use App\Models\MemberReview;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MemberReviewsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('member_review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $memberReviews = MemberReview::with(['user', 'submitted_by'])->get();

        return view('frontend.memberReviews.index', compact('memberReviews'));
    }

    public function create()
    {
        abort_if(Gate::denies('member_review_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $submitted_bies = User::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.memberReviews.create', compact('submitted_bies', 'users'));
    }

    public function store(StoreMemberReviewRequest $request)
    {
        $memberReview = MemberReview::create($request->all());

        return redirect()->route('frontend.member-reviews.index');
    }

    public function edit(MemberReview $memberReview)
    {
        abort_if(Gate::denies('member_review_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $submitted_bies = User::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $memberReview->load('user', 'submitted_by');

        return view('frontend.memberReviews.edit', compact('memberReview', 'submitted_bies', 'users'));
    }

    public function update(UpdateMemberReviewRequest $request, MemberReview $memberReview)
    {
        $memberReview->update($request->all());

        return redirect()->route('frontend.member-reviews.index');
    }

    public function show(MemberReview $memberReview)
    {
        abort_if(Gate::denies('member_review_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $memberReview->load('user', 'submitted_by');

        return view('frontend.memberReviews.show', compact('memberReview'));
    }

    public function destroy(MemberReview $memberReview)
    {
        abort_if(Gate::denies('member_review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $memberReview->delete();

        return back();
    }

    public function massDestroy(MassDestroyMemberReviewRequest $request)
    {
        $memberReviews = MemberReview::find(request('ids'));

        foreach ($memberReviews as $memberReview) {
            $memberReview->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
