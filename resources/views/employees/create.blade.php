@extends('layout.admin')
@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="">Employees</a></li>
    <li class="breadcrumb-item"><a href="">Admin</a></li>
    <li class="breadcrumb-item">Create</li>
</ol>
<div class="card mb-g">
    <h4 class="card-header">
        Basic Information of Employee
    </h4>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('employees.store') }}" method="POST" id="employees_form">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="name">Name:</label>
                        <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name">
                        @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email:</label>
                        <input type="text" id="email" name="email" value="{{old('email')}}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email">
                        @if($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="example-email">Password:</label>
                        <input type="password" id="password" name="password" value="{{old('password')}}" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="password">
                        @if($errors->has('password'))
                        <div class="error">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="example-palaceholder">Phonenumber:</label>
                        <input type="text" id="phonenumber" name="phonenumber" value="{{old('phonenumber')}}" class="form-control {{ $errors->has('phonenumber') ? ' is-invalid' : '' }}" placeholder="Phonenumber">
                        @if($errors->has('phonenumber'))
                        <div class="error">{{ $errors->first('phonenumber') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="org_id">Company:</label>
                        <select id="org_id" name="org_id" class="form-control {{ $errors->has('org_id') ? ' is-invalid' : '' }}">
                            <option value="">Select Company</option>
                            @foreach ($items as $key => $value)
                            <option value="{{ $key }}">
                                {{ $value }}
                            </option>
                            @endforeach
                            @if($errors->has('org_id'))
                            <div class="error">{{ $errors->first('org_id') }}</div>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="example-palaceholder">status:</label>
                        <input type="text" id="status" name="status" value="{{$employeestatus}}" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" placeholder="status" readonly="readonly" >
                        @if($errors->has('status'))
                        <div class="error">{{ $errors->first('status') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                                    <label class="form-label" for="example-textarea">Address:</label>
                                    <textarea class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" id="example-textarea" rows="5" name="address"></textarea>
                                    @if($errors->has('address'))
                                    <div class="error">{{ $errors->first('address') }}</div>
                                    @endif
                                </div>
                    <div class="form-group">
                        <label class="form-label" for="example-palaceholder">Emergencycontact:</label>
                        <input type="text" id="emergencycontact" name="emergencycontact" class="form-control {{ $errors->has('emergencycontact') ? ' is-invalid' : '' }}" value="{{old('emergencycontact')}}" placeholder="emergencycontact">
                        @if($errors->has('emergencycontact'))
                        <div class="error">{{ $errors->first('emergencycontact') }}</div>
                        @endif
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
                name: {
                    required: true,
                    //lettersonly: true
                },
                email: {
                    required: true,
                    maxlength: 50,
                    email: true
                },
                password: {
                    required: true
                },
                phonenumber: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                },
                address: {
                    required: true,
                    maxlength:100,
                },
                emergencycontact: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                },
                org_id: {
                    required: true
                }
            },
            // Specify the validation error messages
            messages: {
                name: {
                    required: "Name is required"
                },
                email: {
                    required: "Email is required"
                },
                password: {
                    required: 'password is required'
                },
                phonenumber: {
                    required: 'phonenumber is required',
                    maxlength: 'Phonenumber cannot be more then 10 characters',
                },
                address: {
                    required: 'address is required'
                },
                emergencycontact: {
                    required: 'emergencycontact is required'
                },
                org_id: {
                    required: 'please select this'
                }

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
