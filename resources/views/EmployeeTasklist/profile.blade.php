@extends('layout.admin')
@section('content')
<ol class="breadcrumb page-breadcrumb">
<li class="breadcrumb-item"><a href="{{route('employees.index')}}">Employees</a></li>
    <li class="breadcrumb-item"><a href="{{route('employees.task')}}">Profile page</a></li>
</ol>
<div class="card mb-g">
    <h4 class="card-header">
        Profile Page
    </h4>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">User name:</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{ isset($profile->employee->name) ? $profile->employee->name : ' '}}" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Email:</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{isset($profile->email) ? $profile->email : ' ' }}" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Phonenumber</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{isset($profile->employee->phonenumber) ? $profile->employee->phonenumber : ' ' }}" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Choose image</label>
                        <div class="col-12 col-lg-6 ">
                            <form action="{{ route('imageupload') }}" method="POST" enctype='multipart/form-data'>
                            @csrf
                                <input type="file" name="images">
                                <input type="submit" value="Upload" class="btn btn-primary">

                            </form>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
</div>
@endsection
