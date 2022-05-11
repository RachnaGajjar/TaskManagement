@extends('layout.admin')
@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('employees.index')}}">Employee</a></li>
    <li class="breadcrumb-item">Show</li>
</ol>
<main id="js-page-content" role="main" class="page-content">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-chart-area'></i> Employee
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <span class="sparklines hidden-lg-down" sparkType="bar" sparkBarColor="#886ab5" sparkHeight="32px" sparkBarWidth="5px" values="3,4,3,6,7,3,3,6,2,6,4"></span>
        </div>
    </div>
    <div class="alert alert-primary">
        <div class="d-flex flex-start w-100">
            <div class="d-flex flex-fill">
                <div class="flex-fill">
                    <span class="h5">Employee's information</span>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Id:</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$employee->id}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Name:</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$employee->name}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Company Name</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{ isset($employee->organization->name) ? $employee->organization->name : ' '}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Email</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{ isset($employee->user->email) ? $employee->user->email : ' '}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Phonenumber</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$employee->phonenumber}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Address</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$employee->address}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Emergencycontact</label>
                        <div class="col-12 col-lg-6 ">
                            <input type="text" class="form-control" value="{{$employee->emergencycontact}}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="alert alert-primary">
        <div class="d-flex flex-start w-100">
            <div class="d-flex flex-fill">
                <div class="flex-fill">
                    <span class="h5">Employee's Working Hours</span>
                    <form method="post" id="myform" action="{{route('employees.workingHours')}}">
                        @csrf
                        <input type="hidden" class="form-control" value="{{$employee->id}}" name="emp_id">
                        <div class="row">
                            <div class="col-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="example-time-2">Day</label>
                                    <input type="text" class="form-control" value="Monday" name="Monday" disabled>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="example-select">Input Select</label>
                                    {{ Form::select('time[monday][start_time]',$datadropdown,isset($time_arr['monday']['start_time']) ? $time_arr['monday']['start_time'] : null, array('class'=>'form-control input-md monday-start')) }}
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="example-select">Input Select</label>
                                    {{ Form::select('time[monday][end_time]',$datadropdown,isset($time_arr['monday']['end_time']) ? $time_arr['monday']['end_time'] : null , array('class'=>'form-control input-md monday-end')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="example-time-2">Day</label>
                                    <input type="text" class="form-control" value="Tuesday" name="Tuesday" disabled>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="example-select" name="job_title" id="job_title">Input Select</label>
                                    {{ Form::select('time[tuesday][start_time]',$datadropdown,isset($time_arr['tuesday']['start_time']) ? $time_arr['tuesday']['start_time'] : null, array('class'=>'form-control input-md tuesday-start')) }}
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="example-select">Input Select</label>
                                    {{ Form::select('time[tuesday][end_time]', $datadropdown,isset($time_arr['tuesday']['end_time']) ? $time_arr['tuesday']['end_time'] : null, array('class'=>'form-control input-md tuesday-end')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="example-time-2">Day</label>
                                    <input type="text" class="form-control" value="Wednesday" name="Wednesday" disabled>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="example-select">Input Select</label>
                                    {{ Form::select('time[wednesday][start_time]', $datadropdown,isset($time_arr['wednesday']['start_time']) ? $time_arr['wednesday']['start_time'] : null, array('class'=>'form-control input-md wednesday-start')) }}
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="example-select">Input Select</label>
                                    {{ Form::select('time[wednesday][end_time]', $datadropdown,isset($time_arr['wednesday']['end_time']) ? $time_arr['wednesday']['end_time'] : null, array('class'=>'form-control input-md wednesday-end')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="example-time-2">Day</label>
                                    <input type="text" class="form-control" value="Thursday" name="Thursday" disabled>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="example-select">Input Select</label>
                                    {{ Form::select('time[thursday][start_time]', $datadropdown,isset($time_arr['thursday']['start_time']) ? $time_arr['thursday']['start_time'] : null, array('class'=>'form-control input-md thursday-start')) }}
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="example-select">Input Select</label>
                                    {{ Form::select('time[thursday][end_time]', $datadropdown,isset($time_arr['thursday']['end_time']) ? $time_arr['thursday']['end_time'] : null, array('class'=>'form-control input-md thursday-end')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="example-time-2">Day</label>
                                    <input type="text" class="form-control" value="Friday" name="Friday" disabled>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="example-select">Input Select</label>
                                    {{ Form::select('time[friday][start_time]', $datadropdown,isset($time_arr['friday']['start_time']) ? $time_arr['friday']['start_time'] : null, array('class'=>'form-control input-md friday-start')) }}
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="example-select">Input Select</label>
                                    {{ Form::select('time[friday][end_time]', $datadropdown,isset($time_arr['friday']['end_time']) ? $time_arr['friday']['end_time'] : null, array('class'=>'form-control input-md friday-end')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="example-time-2"></label>
                                    <input type="text" class="form-control" value="Saturday" name="Saturday" disabled>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="example-select">Input Select</label>
                                    {{ Form::select('time[saturday][start_time]', $datadropdown,isset($time_arr['saturday']['start_time']) ? $time_arr['saturday']['start_time'] : null, array('class'=>'form-control input-md saturday-start')) }}
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="example-select">Input Select</label>
                                    {{ Form::select('time[saturday][end_time]', $datadropdown,  isset($time_arr['saturday']['end_time']) ? $time_arr['saturday']['end_time'] : null, array('class'=>'form-control input-md saturday-end')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="example-time-2"></label>
                                    <input type="text" class="form-control" value="Sunday" name="Sunday" disabled>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="example-select">Input Select</label>
                                    {{ Form::select('time[sunday][start_time]', $datadropdown, isset($time_arr['sunday']['start_time']) ? $time_arr['sunday']['start_time'] : null, array('class'=>'form-control input-md sunday-start')) }}
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="example-select">Input Select</label>
                                    {{ Form::select('time[sunday][end_time]', $datadropdown, isset($time_arr['sunday']['end_time']) ? $time_arr['sunday']['end_time'] : null, array('class'=>'form-control input-md sunday-end')) }}
                                </div>
                            </div>
                        </div>
                        <div class="demo">
                            <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
    </div>
</main>
<nav class="shortcut-menu d-none d-sm-block">
    <input type="checkbox" class="menu-open" name="menu-open" id="menu_open" />
    <a href="dashboard.php" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Scroll Top">
        <i class="fal fa-arrow-up"></i>
    </a>
</nav>
@endsection
@push('scripts');
<script type="text/javascript">
    $(function() {
    $('#btnSubmit').on('click', function() 
    {
            var startTime = $('.monday-start').val();
            var endTime = $('.monday-end').val();

            var st = minFromMidnight(startTime);
            var et = minFromMidnight(endTime);
            if (st > et) 
            {
                alert('End time always greater then start time.');
                return false;
            }
    function minFromMidnight(tm) 
    {
                var ampm = tm.substr(-2);
                var clk;
                if (tm.length <= 6) {
                    clk = tm.substr(0, 4);
                } 
                else 
                {
                    clk = tm.substr(0, 5);
                }
                var m = parseInt(clk.match(/\d+$/)[0], 10);
                var h = parseInt(clk.match(/^\d+/)[0], 10);
                h += (ampm.match(/pm/i)) ? 12 : 0;
                return h * 60 + m;
    }
        });
    });
</script>
 <script>
    $(document).ready(function() {
            $(".monday-start").change(function() 
            {
                var val = this.value;
                console.log(val);
            });
        });
    </script>
    <script>
    $(document).ready(function() {
            $(".monday-end").change(function() 
            {
                var val = this.value;
                if(val >= '18:00')
                {
                    alert('please select valid end time')
                }
               
            });
        });
    </script> -->
<script>
    $(function() {
        $(document).ready(function() {
            $('.monday-start').change(function() {
                $("#myform").validate();
                $(".monday-end").rules("add", {
                    required: true
                });
            });
        });
        $(document).ready(function() {
            $('.monday-end').change(function() {
                $("#myform").validate();
                $(".monday-start").rules("add", {
                    required: true
                });
            });
        });
        $(document).ready(function() {
            $('.tuesday-start').change(function() {
                $("#myform").validate();
                $(".tuesday-end").rules("add", {
                    required: true
                });
            });
        });
        $(document).ready(function() {
            $('.tuesday-end').change(function() {
                $("#myform").validate();
                $(".tuesday-start").rules("add", {
                    required: true
                });
            });
        });
        $(document).ready(function() {
            $('.wednesday-start').change(function() {
                $("#myform").validate();
                $(".wednesday-end").rules("add", {
                    required: true
                });
            });
        });
        $(document).ready(function() {
            $('.wednesday-end').change(function() {
                $("#myform").validate();
                $(".wednesday-start").rules("add", {
                    required: true
                });
            });
        });
        $(document).ready(function() {
            $('.thursday-start').change(function() {
                $("#myform").validate();
                $(".thursday-end").rules("add", {
                    required: true
                });
            });
        });
        $(document).ready(function() {
            $('.thursday-end').change(function() {
                $("#myform").validate();
                $(".thursday-start").rules("add", {
                    required: true
                });
            });
        });
        $(document).ready(function() {
            $('.friday-start').change(function() {
                $("#myform").validate();
                $(".friday-end").rules("add", {
                    required: true
                });
            });
        });
        $(document).ready(function() {
            $('.friday-end').change(function() {
                $("#myform").validate();
                $(".friday-start").rules("add", {
                    required: true
                });
            });
        });
        $(document).ready(function() {
            $('.saturday-start').change(function() {
                $("#myform").validate();
                $(".saturday-end").rules("add", {
                    required: true
                });
            });
        });
        $(document).ready(function() {
            $('.saturday-end').change(function() {
                $("#myform").validate();
                $(".saturday-start").rules("add", {
                    required: true
                });
            });
        });
        $(document).ready(function() {
            $('.sunday-start').change(function() {
                $("#myform").validate();
                $(".sunday-end").rules("add", {
                    required: true
                });
                var starttime = $('.sunday-start').val()
            });
        });
        $(document).ready(function() {
            $('.sunday-end').change(function() {

                $("#myform").validate();
                $(".sunday-start").rules("add", {
                    required: true
                });
                var endtime = $('.sunday-end').val()
            });
        });
    });
</script>
<script>
    $('#btnSubmit').attr('disabled', true);
    var data=$(".monday-start, .monday-end , .tuesday-start, .tuesday-end,.wednesday-start,.wednesday-end,.thursday-start,.thursday-end,.friday-start,.friday-end,.saturday-start,.saturday-end,.sunday-start,.sunday-end").change(function() {
    if (data == true) {
        $('#btnSubmit').attr('disabled', true);
    } else {
        $('#btnSubmit').attr('disabled', false);
    }
});
    </script>
@endpush