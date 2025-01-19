@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.newRequest.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.new-requests.update", [$newRequest->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="pet_id">{{ trans('cruds.newRequest.fields.pet') }}</label>
                <select class="form-control select2 {{ $errors->has('pet') ? 'is-invalid' : '' }}" name="pet_id" id="pet_id" required>
                    @foreach($pets as $id => $entry)
                        <option value="{{ $id }}" {{ (old('pet_id') ? old('pet_id') : $newRequest->pet->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('pet'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pet') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.newRequest.fields.pet_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="available_from">{{ trans('cruds.newRequest.fields.available_from') }}</label>
                <input class="form-control datetime {{ $errors->has('available_from') ? 'is-invalid' : '' }}" type="text" name="available_from" id="available_from" value="{{ old('available_from', $newRequest->available_from) }}">
                @if($errors->has('available_from'))
                    <div class="invalid-feedback">
                        {{ $errors->first('available_from') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.newRequest.fields.available_from_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="available_to">{{ trans('cruds.newRequest.fields.available_to') }}</label>
                <input class="form-control datetime {{ $errors->has('available_to') ? 'is-invalid' : '' }}" type="text" name="available_to" id="available_to" value="{{ old('available_to', $newRequest->available_to) }}">
                @if($errors->has('available_to'))
                    <div class="invalid-feedback">
                        {{ $errors->first('available_to') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.newRequest.fields.available_to_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="credits">{{ trans('cruds.newRequest.fields.credits') }}</label>
                <input class="form-control {{ $errors->has('credits') ? 'is-invalid' : '' }}" type="number" name="credits" id="credits" value="{{ old('credits', $newRequest->credits) }}" step="1" required>
                @if($errors->has('credits'))
                    <div class="invalid-feedback">
                        {{ $errors->first('credits') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.newRequest.fields.credits_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.newRequest.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\NewRequest::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $newRequest->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.newRequest.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="booked_by_id">{{ trans('cruds.newRequest.fields.booked_by') }}</label>
                <select class="form-control select2 {{ $errors->has('booked_by') ? 'is-invalid' : '' }}" name="booked_by_id" id="booked_by_id">
                    @foreach($booked_bies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('booked_by_id') ? old('booked_by_id') : $newRequest->booked_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('booked_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('booked_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.newRequest.fields.booked_by_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection