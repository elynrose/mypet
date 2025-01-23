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
use Auth;

class NewRequestsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('new_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $myRequests = NewRequest::with(['pet', 'booked_by'])
            ->where('booked_by_id', '=', Auth::id())
            ->orderBy('available_to', 'desc')
        ->get();

        $newRequests = NewRequest::with(['pet', 'booked_by'])
        ->where('booked_by_id', '!=', Auth::id())
        ->orderBy('available_to', 'desc')
    ->get();

        return view('frontend.newRequests.index', compact('newRequests', 'myRequests'));
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
        //Check if a booking exists for the same pet and time
        $existingRequest = NewRequest::where('pet_id', $request->pet_id)
            ->where('available_from', '<=', $request->available_from)
            ->where('available_to', '>=', $request->available_to)
            ->where('status', '!=', 'Completed')   
            ->first();
        
            if($existingRequest) {
                return redirect()->back()->with('message', 'A booking already exists for the same pet and time');
            }

        //Booking dates cannot be in the past
        if($request->available_from < now() || $request->available_to < now()) {
            //Send a notification
            //Someone tried to book your pet but the one of the available dates are in the past
            return redirect()->back()->with('message', 'Booking dates cannot be in the past, we have notified the pet owner, please check again later.');

        }
            
    

        $calculateCredits = $this->calculateCredits($request);

        $newRequest = NewRequest::create([
            'pet_id' => $request->pet_id,
            'booked_by_id' => Auth::id(),
            'available_from' => $request->available_from,
            'available_to' => $request->available_to,
            //'not_available' => false,
            'status' => 'New',
            'credits' =>   $calculateCredits,
        ]

        );
       // return redirect()->route('frontend.new-requests.index');
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

    //write a method to calculate total credits based on number of hours requested

    public function calculateCredits(Request $request)
    {
        $available_from = \Carbon\Carbon::parse($request->available_from);
        $available_to = \Carbon\Carbon::parse($request->available_to);
        $hours = $available_from->diffInHours($available_to);
        return $hours * 2;
    }



}
