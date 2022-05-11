@extends('layout.admin')
@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('organizations.index')}}">Organization</a></li>
    <li class="breadcrumb-item">Edit</li>
</ol>
                     <!-- END Page Header -->
                <main id="js-page-content" role="main" class="page-content">
               
                          <div class="card mb-g">
                            <h4 class="card-header">
                               Basic Information of Company
                           </h4>
                           <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('organizations.update',$organization->id) }}" method="POST"> 
                                     @csrf
                                     @method('PUT')
                                        <div class="form-group">
                                            <label class="form-label" for="simpleinput">Name:</label>
                                            <input type="text" id="simpleinput" name="name" class="form-control" placeholder="Name" value="{{ $organization->name }}" >
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="example-email">Starting Year:</label>
                                            <input type="text" id="example-email" name="year" class="form-control" placeholder="Starting Year" value="{{ $organization->year}}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="example-email">Email:</label>
                                            <input type="email" id="example-email" name="email" class="form-control" placeholder="Email" value="{{$organization->email}}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="example-palaceholder">Phonenumber:</label>
                                            <input type="text" id="example-palaceholder" name="phonenumber" class="form-control" placeholder="Phonenumber" value="{{$organization->phonenumber}}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="example-textarea">Address:</label>
                                            <textarea class="form-control" id="example-textarea" rows="5" name="address">{{$organization->address}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="example-palaceholder">Website:</label>
                                            <input type="text" id="example-palaceholder" name="website"class="form-control" placeholder="Website link" value="{{$organization->website}}">
                                        </div>
                                         <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
      @endsection