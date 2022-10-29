@extends('admin.layouts.app')
@section('title')
    {{ 'SubCategory' }}
@endsection
@section('content')
    <div class="card-header py-3">
        <a href="{{ route('subcategory.create') }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i>
            @lang('Add SubCategory')</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>@lang('S.No')</th>
                        <th>@lang('Name')</th>
                        <th>@lang('Date')</th>
                        <th>@lang('Status')</th>
                        <th>@lang('Action')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($module_data as $key=> $data)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                            <td>
                                @if ($data->status == 0)
                                    <span class="badge badge-pill badge-secondary">@lang('Inactive')</span>
                                @elseif($data->status == 1)
                                    <span class="badge badge-pill badge-success">@lang('Active')</span>
                                @endif
                            </td>
                            <td>
                                @if (isset($data['status']) && $data->status == '0')
                                    <a href="#" onclick="active({{ $data['id'] }})"
                                        class="btn btn-sm btn-primary"><i class="fas fa-tasks"></i>
                                        @lang('Active')
                                    </a>
                                @else
                                    <a href="#" onclick="inactive({{ $data['id'] }})"
                                        class="btn btn-sm btn-secondary"><i class="fas fa-tasks"></i>
                                        @lang('Inactive')
                                    </a>
                                @endif
                                <a class="btn btn-sm btn-info" href="{{ route('subcategory.edit', $data->id) }}">
                                    <i class="fa fa-edit"></i> @lang('Edit')
                                </a>
                                <a class="btn btn-sm btn-danger" href="#!" onclick="deleteSupport({{ $data['id'] }})"
                                    title="Delete"><i class="fa fa-trash text-danger"></i>@lang('Delete')</a>
                                <form role='form' id="deleteform_{{ $data['id'] }}"method='POST'
                                    action="{{ route('subcategory.destroy', $data['id']) }}" style='display:none;'>
                                    <input type='hidden' name='_method' value='delete'>"{{ @csrf_field() }}
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%">
                                <p class="text-danger text-center">No result found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    function deleteSupport(id) {
        Swal.fire({
            title: 'Are you sure, you want to delete selected record?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#00c6ff',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('deleteform_' + id).submit();

            }
        })
    }

    function active(id) {
        Swal.fire({
            title: 'Are you sure ?',
            text: "Do you want to active this subcategory.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#00c6ff',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, activate it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: 'get',
                    url: "{{ url('subcategory/update/status/') }}/" + id,
                    success: function(data) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            type: 'success',
                            title: 'SubCategory Activated Successfully.',
                        })
                        setTimeout(function() {
                            location.reload();
                        }, 1000);

                    }
                });
            }
        })
    }

    function inactive(id) {
        Swal.fire({
            title: 'Are you sure ?',
            text: "Do you want to inactive this subcategory.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#00c6ff',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, inactivate it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: 'get',
                    url: "{{ url('subcategory/update/status/') }}/" + id,
                    success: function(data) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            type: 'success',
                            title: 'SubCategory Inactivated Successfully.',
                        })
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                });
            }
        })
    }
</script>
