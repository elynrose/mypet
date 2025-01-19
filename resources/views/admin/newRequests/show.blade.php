@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.newRequest.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.new-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.newRequest.fields.pet') }}
                        </th>
                        <td>
                            {{ $newRequest->pet->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.newRequest.fields.available_from') }}
                        </th>
                        <td>
                            {{ $newRequest->available_from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.newRequest.fields.available_to') }}
                        </th>
                        <td>
                            {{ $newRequest->available_to }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.newRequest.fields.credits') }}
                        </th>
                        <td>
                            {{ $newRequest->credits }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.newRequest.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\NewRequest::STATUS_SELECT[$newRequest->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.newRequest.fields.booked_by') }}
                        </th>
                        <td>
                            {{ $newRequest->booked_by->first_name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.new-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection