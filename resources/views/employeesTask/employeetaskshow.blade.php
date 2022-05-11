@extends('layout.admin')
@section('content')
<ol class="breadcrumb page-breadcrumb">
<li class="breadcrumb-item"><a href="{{route('employees.index')}}">Employees</a></li>
    <li class="breadcrumb-item"><a href="{{route('employees.task')}}">EmployeesTask</a></li>
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
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Id:</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$employeetask->id}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Employee's name</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{ isset($employeetask->employee->name) ? $employeetask->employee->name : ''}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Taskname</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$employeetask->taskname}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Date</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$employeetask->date}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Description</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$employeetask->descriptions}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Starttime</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$employeetask->start_time}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Endtime</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$employeetask->end_time}}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

@endsection
