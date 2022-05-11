@extends('layout.admin')
@section('content')
<ol class="breadcrumb page-breadcrumb">
<li class="breadcrumb-item"><a href="{{route('employees.index')}}">Employees</a></li>
    <li class="breadcrumb-item"><a href="{{route('employees.task')}}">EmployeesTask</a></li>
    <li class="breadcrumb-item">AddTask</li>
</ol>
<div class="card mb-g">
    <h4 class="card-header">
        Add Task For Employees
    </h4>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('employees.taskStore') }}" method="POST" id="employees_form">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="emp_id">Employee's Name:</label>
                        <select id="emp_id" name="emp_id" class="form-control {{ $errors->has('emp_id') ? ' is-invalid' : '' }}">
                            <option value="">Select Item</option>
                            @foreach ($items as $key => $value)
                            <option value="{{ $value }}">
                                {{ $key }}
                            </option>
                            @endforeach
                            @if($errors->has('emp_id'))
                            <div class="error">{{ $errors->first('emp_id') }}</div>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="emp_id">Status:</label>
                        <select id="status" name="status" class="form-control {{ $errors->has('emp_id') ? ' is-invalid' : '' }}">
                           
                            @foreach ($taskstatus as $key => $value)
                            <option value="{{ $value }}" selected>
                                {{ $key }}
                            </option>
                            @endforeach
                            @if($errors->has('emp_id'))
                            <div class="error">{{ $errors->first('emp_id') }}</div>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">TaskName:</label>
                        <input type="text" id="taskname" name="taskname" value="{{old('taskname')}}" class="form-control {{ $errors->has('taskname') ? ' is-invalid' : '' }}" placeholder="TaskName">
                        @if($errors->has('taskname'))
                        <div class="error">{{ $errors->first('taskname') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                    <label class="form-label" for="name">Description:</label>
                        <textarea name="descriptions" id="descriptions" cols="60" rows="5" class="form-control {{ $errors->has('descriptions') ? ' is-invalid' : '' }}"></textarea>
                        @if($errors->has('descriptions'))
                        <div class="error">{{ $errors->first('descriptions') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="example-date">Date</label>
                        <input class="form-control {{ $errors->has('date') ? ' is-invalid' : '' }}" id="date" type="date" name="date" value="{{old('date')}}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="example-time-2">Time</label>
                        <input class="form-control {{ $errors->has('start_time') ? ' is-invalid' : '' }}" id="start_time" type="time" name="start_time" value="{{old('start_time')}}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="example-time-3">Time</label>
                        <input class="form-control {{ $errors->has('end_time') ? ' is-invalid' : '' }}" id="end_time" type="time" name="end_time" value="{{old('end_time')}}">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

<script>
 
    //jquery for validation
    $(function() {
        
        $("#employees_form").validate({
            rules: {
                emp_id:{
                    required :true,
                },
                status:{
                    required:true,
                },
                taskname: {
                    required: true,
                    //lettersonly: true 
                },
                descriptions:{
                    required:true,
                },
                date: {
                    required: true,
                },
                start_time: {
                    required: true,
                },
                end_time: {
                    required: true,
                },
            },
            // Specify the validation error messages
            messages: {
                emp_id:{
                    required: "select Employee Name"
                },
                status:{
                    required: "select task status"
                },
                taskname: {
                    required: "Task is required"
                },
                descriptions: {
                    required: "description is required",
                    minlength: 5
                },
             
                date: {
                    required: "date is required"
                },
                start_time: {
                    required: "start time is required"
                },
                end_time: {
                    required: "end time is required"
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }

        });
    });
</script>
<script>
//     $(document).ready(function() {            
  
//    $('description').prop('required', true);
// });
    </script>



@endpush