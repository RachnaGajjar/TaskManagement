@extends('layout.admin')
@section('content')
<ol class="breadcrumb page-breadcrumb">
<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('employees.index')}}">Employee</a></li>
        <li class="breadcrumb-item">Index</a></li>
</ol>
<!-- END Page Header -->
<main id="js-page-content" role="main" class="page-content">

    <div class="card mb-g">
        <h4 class="card-header">
            Edit Information of employee
        </h4>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('employees.update',$employee->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="form-label" for="simpleinput">Name:</label>
                            <input type="text" id="simpleinput" name="name" class="form-control" placeholder="Name" value="{{ $employee->name }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="example-palaceholder">email:</label>
                            <input type="text" id="example-palaceholder" name="email" class="form-control" placeholder="email" value="{{ isset($employee->user->email) ? $employee->user->email : ' '}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="example-palaceholder">Phonenumber:</label>
                            <input type="text" id="example-palaceholder" name="phonenumber" class="form-control" placeholder="Phonenumber" value="{{$employee->phonenumber}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="org_id">Company:</label>
                            <select id="org_id" name="org_id" class="form-control {{ $errors->has('org_id') ? ' is-invalid' : '' }}">
                                <option value="">Select Item</option>
                                @foreach ($city as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="example-textarea">Address:</label>
                            <textarea class="form-control" id="example-textarea" rows="5" name="address">{{$employee->address}}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="example-palaceholder">Emergencycontact:</label>
                            <input type="text" id="example-palaceholder" name="emergencycontact" class="form-control" placeholder="emergencycontact" value="{{$employee->emergencycontact}}">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
