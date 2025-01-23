@extends('layouts.frontend')

@section('content')
<div class="container">

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="card shadow-sm">
  
        <div class="card-body">
            <form action="{{route('frontend.home')}}" method="GET">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="start_datetime"> <strong>{{ trans('cruds.pet.fields.available_from') }}</strong></label>
                        <div class="input-group">
                            <input class="form-control datetime" type="text" name="available_from" id="available_from" value="{{ old('available_from') }}">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="end_datetime"> <strong>{{ trans('cruds.pet.fields.available_to') }}</strong></label>
                        <div class="input-group">
                            <input class="form-control datetime" type="text" name="available_to" id="available_to" value="{{ old('available_to') }}">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="zip_code"><strong>Zip Code</strong></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ old('zip_code') }}">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">Search for Pets</button>
                </div>
            </form>
        </div>
    </div>

    @if(isset($pets) && $pets->isNotEmpty())
        <div class="row mt-4">
            @foreach($pets as $pet)
                <div class="col-md-4 d-flex align-items-stretch">
                    <div class="card mb-4 shadow-sm w-100">
                        <a href="{{ route('frontend.pets.show', $pet->id) }}" target="_blank" style="display: inline-block;">
                            <img src="{{ $pet->photo->getUrl('preview') }}" class="card-img-top" style="object-fit: cover; height: 200px; width: 100%;">
                        </a>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $pet->name }}</h5>
                            <p class="small"><i class="fas fa-map-pin"></i> {{ $pet->user->zip_code}}</p>
                            <p class="card-text small">{{ $pet->notes }}</p>
                            <p class="alert alert-info small"><i class="fas fa-clock"></i>&nbsp;<strong>{{ trans('global.availability') }}</strong><br>{{ trans('global.from') }}: {{ \Carbon\Carbon::parse($pet->available_from)->format('M d, Y h:i A') }} <br>{{ trans('global.to') }}: {{ \Carbon\Carbon::parse($pet->available_to)->format('M d, Y h:i A') }}</p>
                            <p class="card-text"><small class="text-muted">{{ $pet->zip_code }}</small></p>
                            <form id="{{ $pet->id }}" action="{{ route('frontend.new-requests.store', $pet->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="pet_id" value="{{ $pet->id }}">
                                <input type="hidden" name="available_from" value="{{ \Carbon\Carbon::parse($pet->available_from)->format('Y-m-d H:i:s') }}">
                                <input type="hidden" name="available_to" value="{{ \Carbon\Carbon::parse($pet->available_to)->format('Y-m-d H:i:s') }}">
                            <button class="btn btn-primary mt-auto"><i class="fas fa-calendar"></i> {{ trans('global.book') }} {{ $pet->name }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info mt-4" role="alert">
            Try searching for pets in a your zip code.
        </div>
    @endif
</div>
@endsection