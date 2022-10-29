@extends('admin.layouts.app')
@section('title')
    {{ 'City' }}
@endsection
@section('content')
    <div class="card-body">
        <div class="row">
            <form method="GET" action="{{ route('citySearch') }}">
                <div class="col-md-4">
                    <div class="input-group">
                        <input name="search" value="{{ old('search') }}" type="text" class="form-control"
                            placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-primary p-2" type="submit">Search</button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table" id="userTable">
                <thead>
                    <tr>
                        <th>@lang('S.No')</th>
                        <th>@lang('Name')</th>
                        <th>@lang('Date')</th>
                    </tr>
                </thead>
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
            text: "Do you want to active this product.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#00c6ff',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, activate it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: 'get',
                    url: "{{ url('product/update/status/') }}/" + id,
                    success: function(data) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            type: 'success',
                            title: 'Product Activated Successfully.',
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
            text: "Do you want to inactive this product.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#00c6ff',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, inactivate it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: 'get',
                    url: "{{ url('product/update/status/') }}/" + id,
                    success: function(data) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            type: 'success',
                            title: 'Product Inactivated Successfully.',
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
<script type="text/javascript">
    var table = '';
    $(function() {
        table = $('#userTable').DataTable({
            "language": {
                "zeroRecords": "No record(s) found.",
                searchPlaceholder: "Search records"
            },
            order: [0, 'desc'],
            ordering: true,
            paging: true,
            processing: true,
            serverSide: true,
            lengthChange: true,
            searchable: true,
            ajax: {
                url: "{{ url('city/table/list') }}",
            },
            columns: [{
                    data: 'created_at',
                    name: 'created_at',
                    searchable: false,
                    orderable: true,
                    defaultContent: 'NA',
                    visible: false,
                }, {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
            ]
        });
        $.fn.dataTable.ext.errMode = 'none';
        $('#userTable').on('error.dt', function(e, settings, techNote, message) {
            console.log('An error has been reported by DataTables: ', message);
        })
        $('#btnFiterSubmitSearch').click(function() {
            $('#userTable').DataTable().draw(true);
        });
    });
</script>
