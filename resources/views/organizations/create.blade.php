@extends('layout.admin')
@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
    <li class="breadcrumb-item"><a href="javascript:void(0);">Organizations</a></li>
    <li class="breadcrumb-item">Create</li>
</ol>
<main id="js-page-content" role="main" class="page-content">
    <div class="row">
        <div class="col-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card mb-g">
                <h4 class="card-header">
                    Basic Information of Company
                </h4>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('organizations.store') }}" method="POST"  id="employees_form">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label" for="name">Name:</label>
                                    <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name">
                                    @if($errors->has('name'))
                                    <div class="error">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="example-email">Email:</label>
                                    <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" >
                                    @if($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="example-email">Starting Year:</label>
                                    <input type="text" id="year" name="year" class="form-control {{ $errors->has('year') ? ' is-invalid' : '' }}" placeholder="Starting Year">
                                    @if($errors->has('year'))
                                    <div class="error">{{ $errors->first('year') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="example-palaceholder">Phonenumber:</label>
                                    <input type="text" id="phonenumber" name="phonenumber" class="form-control {{ $errors->has('phonenumber') ? ' is-invalid' : '' }}" placeholder="Phonenumber">
                                    @if($errors->has('phonenumber'))
                                    <div class="error">{{ $errors->first('phonenumber') }}</div>
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
                                    <label class="form-label" for="example-palaceholder">Website:</label>
                                    <input type="text" id="website" name="website" class="form-control {{ $errors->has('website') ? ' is-invalid' : '' }}" placeholder="Website link">
                                    @if($errors->has('website'))
                                    <div class="error">{{ $errors->first('website') }}</div>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</main>
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
                year: {
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
                    maxlength: 100,
                },
                website: {
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
                year: {
                    required: 'password is required'
                },
                phonenumber: {
                    required: 'phonenumber is required',
                    maxlength: 'Phonenumber cannot be more then 10 characters',
                },
                address: {
                    required: 'address is required'
                },
                website: {
                    required: 'website link is required'
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