@extends('Employeedashboardlayout.employee')
@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('employee.dashboard')}}">Employees</a></li>
    <li class="breadcrumb-item"><a href="{{route('employeesleave.employeeleaveIndex')}}">Employee leave</a></li>
    <li class="breadcrumb-item">Index</li>
</ol>
<main id="js-page-content" role="main" class="page-content">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-chart-area'></i> Empolyees Leave
            </h1>
            <div class="row">
                <div class="col-lg-12">
                    <a href="{{ route('employeesleave.employeeleaveCreate') }}" class="btn btn-secondary float-right" role="button">Add
                        Leave</a>
                    </div>
            </div>
            <div class="subheader-block d-lg-flex align-items-center">
                <span class="sparklines hidden-lg-down" sparkType="bar" sparkBarColor="#886ab5" sparkHeight="32px" sparkBarWidth="5px" values="3,4,3,6,7,3,3,6,2,6,4"></span>
            </div>
        </div> 
        
         <div class="row">
                <div class="col-xl-12">
                    <div id="panel-1" class="panel">
                        <div class="panel-container show">
                            <div class="panel-content" style="margin-left:-15px;">
                              <!--    datatable start --> 
                                <table class="table table-bordered data-table" width="100%" >
                                    <thead>
                                        <tr>
                                            <th>reason</th>
                                            <th>status </th>
                                            <th>leave_start_date</th>
                                            <th>leave_end_date</th>
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
    $(function() 
    {
        var table = $('.data-table').DataTable
        ({
            
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: 
            {
                url: "{{ route('employeesleave.indexAjax') }}",
                type: 'POST',
                headers: 
                {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
            },
            columns: 
            [
                {data: 'reason', name: 'reason'},
                {data:'status',name:'status'},
                {data: 'leave_start_date', name: 'leave_start_date'},
                {data: 'leave_end_date', name: 'leave_end_date'},
            ]
            });
                $(".searchEmail").keyup(function() {
                    table.draw();
                });
    });
        </script>
          
    @endpush
 
  