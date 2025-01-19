@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('new_request_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.new-requests.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.newRequest.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.newRequest.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-NewRequest">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.newRequest.fields.pet') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.newRequest.fields.available_from') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.newRequest.fields.available_to') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.newRequest.fields.credits') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.newRequest.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.newRequest.fields.booked_by') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.last_name') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($newRequests as $key => $newRequest)
                                    <tr data-entry-id="{{ $newRequest->id }}">
                                        <td>
                                            {{ $newRequest->pet->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $newRequest->available_from ?? '' }}
                                        </td>
                                        <td>
                                            {{ $newRequest->available_to ?? '' }}
                                        </td>
                                        <td>
                                            {{ $newRequest->credits ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\NewRequest::STATUS_SELECT[$newRequest->status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $newRequest->booked_by->first_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $newRequest->booked_by->last_name ?? '' }}
                                        </td>
                                        <td>
                                            @can('new_request_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.new-requests.show', $newRequest->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('new_request_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.new-requests.edit', $newRequest->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('new_request_delete')
                                                <form action="{{ route('frontend.new-requests.destroy', $newRequest->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('new_request_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.new-requests.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-NewRequest:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection