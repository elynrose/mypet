@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.petReview.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.pet-reviews.update", [$petReview->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="pet_id">{{ trans('cruds.petReview.fields.pet') }}</label>
                <select class="form-control select2 {{ $errors->has('pet') ? 'is-invalid' : '' }}" name="pet_id" id="pet_id" required>
                    @foreach($pets as $id => $entry)
                        <option value="{{ $id }}" {{ (old('pet_id') ? old('pet_id') : $petReview->pet->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('pet'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pet') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.petReview.fields.pet_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="score">{{ trans('cruds.petReview.fields.score') }}</label>
                <input class="form-control {{ $errors->has('score') ? 'is-invalid' : '' }}" type="number" name="score" id="score" value="{{ old('score', $petReview->score) }}" step="1" required>
                @if($errors->has('score'))
                    <div class="invalid-feedback">
                        {{ $errors->first('score') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.petReview.fields.score_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comment">{{ trans('cruds.petReview.fields.comment') }}</label>
                <textarea class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment" id="comment">{{ old('comment', $petReview->comment) }}</textarea>
                @if($errors->has('comment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.petReview.fields.comment_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="submitted_by_id">{{ trans('cruds.petReview.fields.submitted_by') }}</label>
                <select class="form-control select2 {{ $errors->has('submitted_by') ? 'is-invalid' : '' }}" name="submitted_by_id" id="submitted_by_id" required>
                    @foreach($submitted_bies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('submitted_by_id') ? old('submitted_by_id') : $petReview->submitted_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('submitted_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('submitted_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.petReview.fields.submitted_by_helper') }}</span>
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