@extends('layouts.frontend')
@section('content')
<div class="container">
    <form method="POST" action="{{ route('frontend.pets.update', [$pet->id]) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="needsclick dropzone" id="photo-dropzone"></div>
                            @if($errors->has('photo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('photo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pet.fields.photo_helper') }}</span>
                        </div>
                    </div>
                </div>

                
            </div>

            <div class="col-md-9">
            <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <div class="row">
                        <div class="form-group col-6">
                            <label for="available_from">{{ trans('cruds.pet.fields.available_from') }}</label>
                            <input class="form-control datetime" type="text" name="available_from" id="available_from" value="{{ old('available_from', $pet->available_from) }}">
                            @if($errors->has('available_from'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('available_from') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pet.fields.available_from_helper') }}</span>
                        </div>
                        <div class="form-group col-6">
                            <label for="available_to">{{ trans('cruds.pet.fields.available_to') }}</label>
                            <input class="form-control datetime" type="text" name="available_to" id="available_to" value="{{ old('available_to', $pet->available_to) }}">
                            @if($errors->has('available_to'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('available_to') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pet.fields.available_to_helper') }}</span>
                        </div>
</div>

<div class="form-group form-check">
                            <input type="hidden" name="not_available" value="0">
                            <input type="checkbox" class="form-check-input" name="not_available" id="not_available" value="1" {{ $pet->not_available || old('not_available', 0) === 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="not_available">{{ trans('cruds.pet.fields.not_available') }}</label>
                            @if($errors->has('not_available'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('not_available') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pet.fields.not_available_helper') }}</span>
                        </div>
                    </div>
                    
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                       

                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.pet.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $pet->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pet.fields.name_helper') }}</span>
                        </div>

                        <div class="form-group">
                            <label class="required" for="age">{{ trans('cruds.pet.fields.age') }}</label>
                            <input class="form-control" type="number" name="age" id="age" value="{{ old('age', $pet->age) }}" step="1" required>
                            @if($errors->has('age'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('age') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pet.fields.age_helper') }}</span>
                        </div>

                        <div class="form-group">
                            <label class="required">{{ trans('cruds.pet.fields.gender') }}</label>
                            <select class="form-control" name="gender" id="gender" required>
                                <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Pet::GENDER_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('gender', $pet->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('gender'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('gender') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pet.fields.gender_helper') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="notes">{{ trans('cruds.pet.fields.notes') }}</label>
                            <input class="form-control" type="text" name="notes" id="notes" value="{{ old('notes', $pet->notes) }}">
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pet.fields.notes_helper') }}</span>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    Dropzone.options.photoDropzone = {
        url: '{{ route('frontend.pets.storeMedia') }}',
        maxFilesize: 2, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        maxFiles: 1,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
            size: 2,
            width: 4096,
            height: 4096
        },
        success: function (file, response) {
            $('form').find('input[name="photo"]').remove();
            $('form').append('<input type="hidden" name="photo" value="' + response.name + '">');
        },
        removedfile: function (file) {
            file.previewElement.remove();
            if (file.status !== 'error') {
                $('form').find('input[name="photo"]').remove();
                this.options.maxFiles = this.options.maxFiles + 1;
            }
        },
        init: function () {
            @if(isset($pet) && $pet->photo)
                var file = {!! json_encode($pet->photo) !!};
                this.options.addedfile.call(this, file);
                this.options.thumbnail.call(this, file, file.preview ?? file.preview_url);
                file.previewElement.classList.add('dz-complete');
                $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">');
                this.options.maxFiles = this.options.maxFiles - 1;
            @endif
        },
        error: function (file, response) {
            var message = $.type(response) === 'string' ? response : response.errors.file;
            file.previewElement.classList.add('dz-error');
            var _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]');
            _ref.forEach(function (node) {
                node.textContent = message;
            });
        }
    };
</script>
@endsection
