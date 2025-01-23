@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="display-5 font-weight-bold text-dark mb-5">New Requests</h2>

            <nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Member Requests</button>
    <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">My Requests</button>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active mt-5" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
  @foreach($newRequests as $key => $newRequest)
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2 col-sm-12 text-center">
                                    <img src="{{ $newRequest->pet->photo->getUrl('preview') }}" class="shadow" style="object-fit: cover; min-height: 100px; width: 100%; border-radius: 5px; margin-bottom: 10px; margin-right: 10px; margin-top: 0px; margin-left: 10px;">
                                    
                                </div>
                                <div class="col-md-8 col-sm-12">
                                    <h5 class="card-title">{{ $newRequest->pet->name ?? '' }}</h5>
                                    <p>
                                        <strong>Caregiver:</strong> {{ $newRequest->booked_by->first_name ?? '' }} {{ $newRequest->booked_by->last_name ?? '' }}<br>
                                        <span class="small">
                                            <i class="fas fa-calendar"></i> {{ $newRequest->available_from ? \Carbon\Carbon::parse($newRequest->available_from)->format('d M Y, h:i A') : '' }} - {{ $newRequest->available_to ? \Carbon\Carbon::parse($newRequest->available_to)->format('d M Y, h:i A') : '' }}<br>
                                            <i class="fas fa-clock"></i>&nbsp; {{ $newRequest->status }}<br>
                                            <i class="fas fa-money"></i> {{ trans('cruds.newRequest.fields.credits') }}: {{ $newRequest->credits ?? '' }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div style="position: absolute; right: 10px; top: 10px;">
                                @can('new_request_delete')
                                <form action="{{ route('frontend.new-requests.destroy', $newRequest->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-default btn-xs" value="{{ trans('global.delete') }}"><i class="fas fa-trash"></i></button>
                                </form>
                                @endcan
                            </div>
                            @if(\Carbon\Carbon::parse($newRequest->available_to)->isPast() && $newRequest->status != "Completed")
                             <span class="mt-3 text-right" style="display:block;">
                            <a href="#" class="btn btn-info btn-sm text-right"><i class="fas fa-warning"></i> Mark Completed</a></span>
                            @elseif($newRequest->status === "Completed"  && \Carbon\Carbon::parse($newRequest->available_to)->isPast())
                            <span class="mt-3 text-right" style="display:block;">
                                <a class="btn btn-warning btn-sm" href="{{ route('frontend.new-requests.show', $newRequest->id) }}">Submit Review</a>
                            </span>
                    
                            @elseif(\Carbon\Carbon::parse($newRequest->available_to)->isFuture())
                            @if($newRequest->status == "New")
                            <span class="mt-3 text-right" style="display:block;">
                                <a class="btn btn-primary btn-sm" href="{{ route('frontend.new-requests.show', $newRequest->id) }}">Accept</a>
                                <a class="btn btn-danger btn-sm" href="{{ route('frontend.new-requests.show', $newRequest->id) }}">Decline</a>
                            </span>
                            @elseif($newRequest->status == "Accepted")
                            <span class="mt-3 text-right" style="display:block;">
                                <a class="btn btn-primary btn-sm" href="{{ route('frontend.new-requests.show', $newRequest->id) }}">Mark as Completed</a>
                            </span>
                            @elseif($newRequest->status == "Ongoing")
                            <span class="mt-3 text-right" style="display:block;">
                                <a class="btn btn-primary btn-sm" href="{{ route('frontend.new-requests.show', $newRequest->id) }}">Contact Owner</a>
                            </span>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
                </div>
                @endforeach

  </div>
  <div class="tab-pane fade mt-5" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
  @foreach($myRequests as $key => $myRequest)
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2 col-sm-12 text-center">
                                    <img src="{{ $myRequest->pet->photo->getUrl('preview') }}" class="shadow" style="object-fit: cover; min-height: 100px; width: 100%; border-radius: 5px; margin-bottom: 10px; margin-right: 10px; margin-top: 0px; margin-left: 10px;">
                                  
                                </div>
                                <div class="col-md-8 col-sm-12">
                                    <h5 class="card-title">{{ $myRequest->pet->name ?? '' }}</h5>
                                    <p>
                                        <strong>Caregiver:</strong> {{ $myRequest->booked_by->first_name ?? '' }} {{ $myRequest->booked_by->last_name ?? '' }}<br>
                                        <span class="small">
                                            <i class="fas fa-calendar"></i> {{ $myRequest->available_from ? \Carbon\Carbon::parse($myRequest->available_from)->format('d M Y, h:i A') : '' }} - {{ $myRequest->available_to ? \Carbon\Carbon::parse($myRequest->available_to)->format('d M Y, h:i A') : '' }}<br>
                                            <i class="fas fa-clock"></i>&nbsp; {{ $myRequest->status }}<br>
                                            <i class="fas fa-money"></i> {{ trans('cruds.newRequest.fields.credits') }}: {{ $myRequest->credits ?? '' }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div style="position: absolute; right: 10px; top: 10px;">
                                @can('new_request_delete')
                                <form action="{{ route('frontend.new-requests.destroy', $myRequest->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-default btn-xs" value="{{ trans('global.delete') }}"><i class="fas fa-trash"></i></button>
                                </form>
                                @endcan
                            </div>
                            @if(\Carbon\Carbon::parse($myRequest->available_to)->isPast() && $myRequest->status != "Completed")
                             <span class="mt-3 text-right" style="display:block;">
                            <a href="#" class="btn btn-info btn-sm text-right"><i class="fas fa-warning"></i> Mark Completed</a></span>
                            @elseif($myRequest->status === "Completed"  && \Carbon\Carbon::parse($myRequest->available_to)->isPast())
                            <span class="mt-3 text-right" style="display:block;">
                                <a href="#" class="btn btn-warning btn-sm" href="{{ route('frontend.new-requests.show', $myRequest->id) }}"><i class="fas fa-thumbs-up"></i> Submit Review</a>
                            </span>
                    
                            @elseif(\Carbon\Carbon::parse($myRequest->available_to)->isFuture())
                            @if($myRequest->status == "New")
                            <span class="mt-3 text-right" style="display:block;">
                                <a class="btn btn-primary btn-sm" href="{{ route('frontend.new-requests.show', $myRequest->id) }}">Accept</a>
                                <a class="btn btn-danger btn-sm" href="{{ route('frontend.new-requests.show', $myRequest->id) }}">Decline</a>
                            </span>
                            @elseif($myRequest->status == "Accepted")
                            <span class="mt-3 text-right" style="display:block;">
                                <a class="btn btn-primary btn-sm" href="{{ route('frontend.new-requests.show', $myRequest->id) }}"> <i class="fas fa-check"></i>Mark as Completed</a>
                            </span>
                            @elseif($myRequest->status == "Ongoing")
                            <span class="mt-3 text-right" style="display:block;">
                                <a class="btn btn-primary btn-sm" href="{{ route('frontend.new-requests.show', $myRequest->id) }}"><i class="fas fa-comment"></i> Contact Owner</a>
                            </span>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
                </div>
                @endforeach

  </div>
</div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
        // Your existing script can be removed as it is related to DataTables
    });
</script>
@endsection
