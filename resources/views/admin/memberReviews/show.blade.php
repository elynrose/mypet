@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.memberReview.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.member-reviews.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.memberReview.fields.id') }}
                        </th>
                        <td>
                            {{ $memberReview->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.memberReview.fields.user') }}
                        </th>
                        <td>
                            {{ $memberReview->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.memberReview.fields.score') }}
                        </th>
                        <td>
                            {{ $memberReview->score }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.memberReview.fields.comment') }}
                        </th>
                        <td>
                            {{ $memberReview->comment }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.memberReview.fields.submitted_by') }}
                        </th>
                        <td>
                            {{ $memberReview->submitted_by->first_name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.member-reviews.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection