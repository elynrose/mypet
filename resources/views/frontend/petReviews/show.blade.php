@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.petReview.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.pet-reviews.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.petReview.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $petReview->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.petReview.fields.pet') }}
                                    </th>
                                    <td>
                                        {{ $petReview->pet->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.petReview.fields.score') }}
                                    </th>
                                    <td>
                                        {{ $petReview->score }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.petReview.fields.comment') }}
                                    </th>
                                    <td>
                                        {{ $petReview->comment }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.petReview.fields.submitted_by') }}
                                    </th>
                                    <td>
                                        {{ $petReview->submitted_by->first_name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.pet-reviews.index') }}">
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