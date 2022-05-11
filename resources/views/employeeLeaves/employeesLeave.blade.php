@extends('Employeedashboardlayout.employee')
@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('employee.dashboard')}}">Employees</a></li>
    <li class="breadcrumb-item"><a href="{{route('employeesleave.employeeleaveIndex')}}">Employee Leave </a> </li>
    <li class="breadcrumb-item">Add Leave</li>
</ol>
<div class="card mb-g">
    <h4 class="card-header">
        Apply for Leave
    </h4>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
            <form action="{{ route('employeesleave.employeeleaveStore') }}" method="POST" id="validation_form">
                    @csrf
                  
                    
                <div class="form-group">
                    <label class="form-label" for="reason">Reason:</label>
                        <textarea name="reason" id="reason" cols="60" rows="5" class="form-control {{ $errors->has('reason') ? ' is-invalid' : '' }}">{{old('reason')}}</textarea>
                        @if($errors->has('reason'))
                        <div class="error">{{ $errors->first('reason') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="example-date">Start Date:</label>
                        <input class="form-control {{ $errors->has('leave_start_date') ? ' is-invalid' : '' }}" id="leave_start_date" type="date" name="leave_start_date" value="{{old('leave_start_date')}}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="example-date">End Date:</label>
                        <input class="form-control {{ $errors->has('leave_end_date') ? ' is-invalid' : '' }}" id="leave_end_date" type="date" name="leave_end_date" value="{{old('leave_end_date')}}">
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
        
        $("#validation_form").validate({ 
            rules: {
                emp_id: {
                    required: true,
                    //lettersonly: true 
                },
                status:{
                    required:true,
                },
                reason:{
                    required:true,
                    maxlength:100,
                },
                date: {
                    required: true,
                },
                leave_end_date: {
                    required: true,
                },
                leave_start_date: {
                    required: true,
                },
               
            },
            // Specify the validation error messages
            messages: {
                emp_id: {
                    required: "Please select Employee's Name"
                },
                status :{
                    required: "please select"
                },
                
                reason: 
                {
                    required: "reason is required",
                    minlength: 5
                },
                date: 
                {
                    required: "date is required"
                },
                leave_end_date: 
                {
                    required: "date is required"
                },
                leave_start_date: 
                {
                    required: "date is required"
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
@endpush