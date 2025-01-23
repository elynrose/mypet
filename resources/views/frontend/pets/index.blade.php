@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('pet_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.pets.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.pet.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            

                    <div class="row mt-5">
                        @foreach($pets as $key => $pet)
                            <div class="col-md-4 d-flex align-items-stretch">
                                <div class="card mb-4 shadow-sm w-100">
                                        <img src="{{ $pet->photo->getUrl('preview') }}" class="card-img-top" style="object-fit: cover; height: 200px; width: 100%;">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $pet->name }}</h5>
                                        <p class="small"><i class="fas fa-map-pin"></i> {{ $pet->user->zip_code }}</p>
                                        <p class="card-text small">{{ $pet->notes }}</p>
                                        <p class="alert alert-info small"><i class="fas fa-clock"></i>&nbsp;<strong>{{ trans('global.availability') }}</strong><br>{{ trans('global.from') }}: {{ \Carbon\Carbon::parse($pet->available_from)->format('M d, Y h:i A') }} <br>{{ trans('global.to') }}: {{ \Carbon\Carbon::parse($pet->available_to)->format('M d, Y h:i A') }}</p>
                                        <p class="card-text"><small class="text-muted">{{ $pet->zip_code }}</small></p>
                                        <a href="{{ route('frontend.pets.edit', $pet->id) }}" class="btn btn-primary mt-auto"><i class="fas fa-edit"></i> {{ trans('global.edit') }} {{ $pet->name }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
           

        </div>
    </div>
</div>
@endsection
