@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.petReview.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.pet-reviews.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="pet_id">{{ trans('cruds.petReview.fields.pet') }}</label>
                            <select class="form-control select2" name="pet_id" id="pet_id" required>
                                @foreach($pets as $id => $entry)
                                    <option value="{{ $id }}" {{ old('pet_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <input class="form-control" type="number" name="score" id="score" value="{{ old('score', '') }}" step="1" required>
                            @if($errors->has('score'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('score') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.petReview.fields.score_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="comment">{{ trans('cruds.petReview.fields.comment') }}</label>
                            <textarea class="form-control" name="comment" id="comment">{{ old('comment') }}</textarea>
                            @if($errors->has('comment'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('comment') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.petReview.fields.comment_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="submitted_by_id">{{ trans('cruds.petReview.fields.submitted_by') }}</label>
                            <select class="form-control select2" name="submitted_by_id" id="submitted_by_id" required>
                                @foreach($submitted_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ old('submitted_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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

        </div>
    </div>
</div>
@endsection