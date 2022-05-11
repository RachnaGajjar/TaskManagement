@extends('layout.admin')
@section('content')
<ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('employees.index')}}">Employee</a></li>
        <li class="breadcrumb-item">Index</a></li>

    </ol>
    <main id="js-page-content" role="main" class="page-content">
        <main id="js-page-content" role="main" class="page-content">
            <div class="subheader">
                <h1 class="subheader-title">
                    <i class='subheader-icon fal fa-chart-area'></i> Empolyees List
                </h1>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="{{ route('employees.create') }}" class="btn btn-secondary float-right" role="button">Add
                            Employee</a>

                    </div>

                </div>
                <div class="subheader-block d-lg-flex align-items-center">
                    <span class="sparklines hidden-lg-down" sparkType="bar" sparkBarColor="#886ab5" sparkHeight="32px"
                        sparkBarWidth="5px" values="3,4,3,6,7,3,3,6,2,6,4"></span>
                </div>

            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div id="panel-1" class="panel">
                        <div class="panel-container show">
                            <div class="panel-content" style="margin-left:-15px;">
                                <!-- datatable start -->
                                <table class="table table-bordered data-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Companyname</th>
                                            <th> Status </th>
                                            <th>Phonenumber</th>
                                            <th> Address </th>
                                            <th> EmergencyContact </th>
                                            <th width="100px">Action</th>
                                            <th width="100px">Action</th>
                                            <th width="100px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure you want to delete this category?</h5>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-primary yes_delete">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

        </div>
    </div>
    @endsection
    @push('scripts');

        <script type="text/javascript">
            $(function() {
                var table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('employees.indexAjax') }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        },
                    },
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'organization.name', name: 'organization.name'},
                        {data: 'status', name: 'status'},
                        {data: 'phonenumber', name: 'phonenumber'},
                        {data: 'address', name: 'address'},
                        {data: 'emergencycontact', name: 'emergencycontact'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                        {data: 'show', searchable: false, orderable: false},
                        {data: 'delete', searchable: false, orderable: false},
                    ]
                });
                $(".searchEmail").keyup(function() {
                    table.draw();
                });
            });
        </script>

        <script>
            $(document).on("click", ".deleteCat", function () {
                var delete_id = $(this).attr('id');
                console.log(delete_id);
                $(".yes_delete").attr('id', delete_id);
                // $("#deleteModal").modal('show');
            });

            $(document).on("click", ".yes_delete", function () {
                let delete_id = $(this).attr('id');
                $.ajax({
                    url: '{{ URL::to("employees") }}' + '/' + delete_id,
                    type: 'POST',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {'_method': 'DELETE',},
                    success: function(result) {
                        window.location = '{{route("employees.index")}}';
                    }
                });
            });

        </script>
        <script>
            $("#target").click(function()
            {
                alert('hello')
            });
        </script>
@endpush
