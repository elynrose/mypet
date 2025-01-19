<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPetReviewRequest;
use App\Http\Requests\StorePetReviewRequest;
use App\Http\Requests\UpdatePetReviewRequest;
use App\Models\Pet;
use App\Models\PetReview;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PetReviewsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pet_review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $petReviews = PetReview::with(['pet', 'submitted_by'])->get();

        return view('admin.petReviews.index', compact('petReviews'));
    }

    public function create()
    {
        abort_if(Gate::denies('pet_review_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pets = Pet::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $submitted_bies = User::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.petReviews.create', compact('pets', 'submitted_bies'));
    }

    public function store(StorePetReviewRequest $request)
    {
        $petReview = PetReview::create($request->all());

        return redirect()->route('admin.pet-reviews.index');
    }

    public function edit(PetReview $petReview)
    {
        abort_if(Gate::denies('pet_review_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pets = Pet::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $submitted_bies = User::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $petReview->load('pet', 'submitted_by');

        return view('admin.petReviews.edit', compact('petReview', 'pets', 'submitted_bies'));
    }

    public function update(UpdatePetReviewRequest $request, PetReview $petReview)
    {
        $petReview->update($request->all());

        return redirect()->route('admin.pet-reviews.index');
    }

    public function show(PetReview $petReview)
    {
        abort_if(Gate::denies('pet_review_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $petReview->load('pet', 'submitted_by');

        return view('admin.petReviews.show', compact('petReview'));
    }

    public function destroy(PetReview $petReview)
    {
        abort_if(Gate::denies('pet_review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $petReview->delete();

        return back();
    }

    public function massDestroy(MassDestroyPetReviewRequest $request)
    {
        $petReviews = PetReview::find(request('ids'));

        foreach ($petReviews as $petReview) {
            $petReview->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
