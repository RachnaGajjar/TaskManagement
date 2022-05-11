<!-- @extends('layout.admin')
@section('content')
<ol class="breadcrumb page-breadcrumb">
<li class="breadcrumb-item"><a href="{{route('employee.dashboard')}}">Employees</a></li>
    <li class="breadcrumb-item"><a href="{{route('employeesleave.employeeleaveIndex')}}">Employee leave</a></li>
    <li class="breadcrumb-item">Edit</a></li>
</ol>
<main id="js-page-content" role="main" class="page-content">

    <div class="card mb-g">
        <h4 class="card-header">
            Update Leave Application
        </h4>
        <div class="card-body">
        <div class="row">
            <div class="col-12">
            <form action="{{ route('employeesleave.employeeleaveAdminUpdate',$employeeleave->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                        <label class="form-label" for="emp_id">Employee's Name:</label>
                        <select id="emp_id" name="emp_id" class="form-control {{ $errors->has('emp_id') ? ' is-invalid' : '' }}">
                            <option value="">Select Item</option>
                            @foreach ($items as $key => $value)
                            @if ($employeeleave->emp_id == $key)
                                <option value="{{ $key }}" selected>{{ $value }}</option>
                                @else
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endif
                                @endforeach
                            @if($errors->has('emp_id'))
                            <div class="error">{{ $errors->first('emp_id') }}</div>
                            @endif
                        </select>
                        </div>
                    <div class="form-group">
                        <label class="form-label" for="status">Status:</label>
                        <select id="status" name="status" class="form-control {{ $errors->has('emp_id') ? ' is-invalid' : '' }}">
                       
                            @foreach ($leavestatus as $key => $value)
                            @if ($employeeleave->status == $key)
                                <option value="{{ $key }}" selected>{{ $value }}</option>
                                @else
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endif
                                @endforeach
                            @if($errors->has('status'))
                            <div class="error">{{ $errors->first('status') }}</div>
                            @endif
                        </select>
                        </div>
                <div class="form-group">
                    <label class="form-label" for="reason">Reason:</label>
                        <textarea name="reason" id="reason" cols="60" rows="5" class="form-control {{ $errors->has('reason') ? ' is-invalid' : '' }}">{{$employeeleave->reason}}</textarea>
                        @if($errors->has('reason'))
                        <div class="error">{{ $errors->first('reason') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="example-date">Applied Date:</label>
                        <input class="form-control {{ $errors->has('date') ? ' is-invalid' : '' }}" id="date" type="date" name="date" value="{{$employeeleave->date}}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="example-date">Start Date:</label>
                        <input class="form-control {{ $errors->has('date') ? ' is-invalid' : '' }}" id="leave_start_date" type="date" name="leave_start_date" value="{{$employeeleave->leave_start_date}}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="example-date">End Date:</label>
                        <input class="form-control {{ $errors->has('date') ? ' is-invalid' : '' }}" id="leave_end_date" type="date" name="leave_end_date" value="{{$employeeleave->leave_end_date}}">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection -->