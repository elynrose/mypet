<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NewRequest;
use App\Models\User;



class HomeController
{
    public function index(Request $request)
    {
        //Search for pets using the search form. Available dates and zip code
        if($request->has('zip_code') && $request->has('available_from') && $request->has('available_to')) {
            $pets = Pet::where('available_from', '<=', Carbon::now())
                ->where('available_to', '>=', Carbon::now())
                ->where('user_id', '!=', Auth::id())
                ->where('not_available', false)
                ->whereHas('user', function($query) use ($request) {
                    $query->where('zip_code', $request->zip_code);
                })
                //find the most recent new request for this pet if status is not completed, dont include it
                ->whereDoesntHave('new_requests', function($query) {
                    $query->where('status', '!=', 'Completed');
                })
                
                ->get();

            return view('frontend.home', compact('pets'));
        }
        return view('frontend.home');
    }
}
