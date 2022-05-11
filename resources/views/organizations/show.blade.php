@extends('layout.admin')
@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('organizations.index')}}">Organization</a></li>
    <li class="breadcrumb-item">Show</li>
</ol>
<main id="js-page-content" role="main" class="page-content">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-chart-area'></i> Organization
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <span class="sparklines hidden-lg-down" sparkType="bar" sparkBarColor="#886ab5" sparkHeight="32px" sparkBarWidth="5px" values="3,4,3,6,7,3,3,6,2,6,4"></span>
        </div>
    </div>
    <div class="alert alert-primary">
        <div class="d-flex flex-start w-100">
            <div class="d-flex flex-fill">
                <div class="flex-fill">
                    <span class="h5">Organization's information</span>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Id:</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$organization->id}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Name:</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$organization->name}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Year:</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$organization->year}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Email</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$organization->email}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Address</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$organization->address}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Phonenumber</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$organization->phonenumber}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Website</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$organization->website}}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</main>
<!-- BEGIN Page Footer -->
<!--footer -->
<nav class="shortcut-menu d-none d-sm-block">
    <input type="checkbox" class="menu-open" name="menu-open" id="menu_open" />
    <a href="dashboard.php" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Scroll Top">
        <i class="fal fa-arrow-up"></i>
    </a>
</nav>
@endsection