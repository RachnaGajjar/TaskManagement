<!-- @extends('Employeedashboardlayout.employee')
@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('employee.dashboard')}}">Employees</a></li>
    <li class="breadcrumb-item"><a href="{{route('employeesleave.employeeleaveIndex')}}">Employee Leave</a></li>
    <li class="breadcrumb-item">Show</li>
</ol>
<div class="card mb-g">
    <h4 class="card-header">
        Add Task For Employees
    </h4>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Employee's name:</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{ isset($employeetask->employee->name) ? $employeetask->employee->name : ''}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Status:</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$employeetask->status}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Date</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$employeetask->date}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Date</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$employeetask->date}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">reason</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$employeetask->reason}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">leave_start_date</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$employeetask->leave_start_date}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">leave_end_date</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$employeetask->leave_end_date}}" disabled>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
 -->