@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.memberReview.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.member-reviews.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="user_id">{{ trans('cruds.memberReview.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.memberReview.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="score">{{ trans('cruds.memberReview.fields.score') }}</label>
                            <input class="form-control" type="number" name="score" id="score" value="{{ old('score', '') }}" step="1" required>
                            @if($errors->has('score'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('score') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.memberReview.fields.score_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="comment">{{ trans('cruds.memberReview.fields.comment') }}</label>
                            <textarea class="form-control" name="comment" id="comment">{{ old('comment') }}</textarea>
                            @if($errors->has('comment'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('comment') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.memberReview.fields.comment_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="submitted_by_id">{{ trans('cruds.memberReview.fields.submitted_by') }}</label>
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
                            <span class="help-block">{{ trans('cruds.memberReview.fields.submitted_by_helper') }}</span>
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