@extends('layout.admin')
@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('employeeleaveAdminIndex')}}">Employee leave</a></li>
    <li class="breadcrumb-item">Index</li>
</ol>
<main id="js-page-content" role="main" class="page-content">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-chart-area'></i> Empolyees Leave list
        </h1>

        <div class="subheader-block d-lg-flex align-items-center">
            <span class="sparklines hidden-lg-down" sparkType="bar" sparkBarColor="#886ab5" sparkHeight="32px" sparkBarWidth="5px" values="3,4,3,6,7,3,3,6,2,6,4"></span>
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
                                    <th>status</th>
                                    <th>reason</th>
                                    <th>leave_start_date</th>
                                    <th>leave_end_date</th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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
                    url: "{{ route('Adminindexajax') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                },
                columns: [{
                        data: 'employee.name',
                        name: 'employee.name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'reason',
                        name: 'reason'
                    },
                    {
                        data: 'leave_start_date',
                        name: 'leave_start_date'
                    },
                    {
                        data: 'leave_end_date',
                        name: 'leave_end_date'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ]
            });
            $(".searchEmail").keyup(function() {
                table.draw();
            });
        });
    </script>
    <script>
        $(document).on("click", ".approved", function() {
            var id = $(this).attr('id');
            var status = 'approved';
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/approvedajax', // This is what I have updated
                data: {
                    leave_id: id,
                    leave_status: status
                },
                success: function(response) {

                    window.location = '/employeeleave/AdminIndex';
                }
            });
        });
    </script>
    <script>
        $(document).on("click", ".decline", function() {
            var id = $(this).attr('id');
            var status = 'decline'
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/declinedajax',
                data: {
                    leave_id: id,
                    leave_status: status
                },
                success: function(response) {
                    window.location = '/employeeleave/AdminIndex';
                }
            })

        });
    </script>
    @endpush