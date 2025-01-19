<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyNewRequestRequest;
use App\Http\Requests\StoreNewRequestRequest;
use App\Http\Requests\UpdateNewRequestRequest;
use App\Models\NewRequest;
use App\Models\Pet;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NewRequestsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('new_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $newRequests = NewRequest::with(['pet', 'booked_by'])->get();

        return view('frontend.newRequests.index', compact('newRequests'));
    }

    public function create()
    {
        abort_if(Gate::denies('new_request_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pets = Pet::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $booked_bies = User::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.newRequests.create', compact('booked_bies', 'pets'));
    }

    public function store(StoreNewRequestRequest $request)
    {
        $newRequest = NewRequest::create($request->all());

        return redirect()->route('frontend.new-requests.index');
    }

    public function edit(NewRequest $newRequest)
    {
        abort_if(Gate::denies('new_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pets = Pet::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $booked_bies = User::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $newRequest->load('pet', 'booked_by');

        return view('frontend.newRequests.edit', compact('booked_bies', 'newRequest', 'pets'));
    }

    public function update(UpdateNewRequestRequest $request, NewRequest $newRequest)
    {
        $newRequest->update($request->all());

        return redirect()->route('frontend.new-requests.index');
    }

    public function show(NewRequest $newRequest)
    {
        abort_if(Gate::denies('new_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $newRequest->load('pet', 'booked_by');

        return view('frontend.newRequests.show', compact('newRequest'));
    }

    public function destroy(NewRequest $newRequest)
    {
        abort_if(Gate::denies('new_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $newRequest->delete();

        return back();
    }

    public function massDestroy(MassDestroyNewRequestRequest $request)
    {
        $newRequests = NewRequest::find(request('ids'));

        foreach ($newRequests as $newRequest) {
            $newRequest->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
