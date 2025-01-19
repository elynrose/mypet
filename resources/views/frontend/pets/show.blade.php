@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.pet.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.pets.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pet.fields.photo') }}
                                    </th>
                                    <td>
                                        @if($pet->photo)
                                            <a href="{{ $pet->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $pet->photo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pet.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $pet->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pet.fields.age') }}
                                    </th>
                                    <td>
                                        {{ $pet->age }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pet.fields.gender') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Pet::GENDER_SELECT[$pet->gender] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pet.fields.notes') }}
                                    </th>
                                    <td>
                                        {{ $pet->notes }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pet.fields.not_available') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $pet->not_available ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pet.fields.available_from') }}
                                    </th>
                                    <td>
                                        {{ $pet->available_from }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pet.fields.available_to') }}
                                    </th>
                                    <td>
                                        {{ $pet->available_to }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pet.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $pet->user->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.pets.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection