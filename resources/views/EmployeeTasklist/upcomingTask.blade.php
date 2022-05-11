@extends('Employeedashboardlayout.employee')
@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('employee.dashboard')}}">Dashboard </a> </li>
    <li class="breadcrumb-item">Upcoming task</li>
</ol>
<main id="js-page-content" role="main" class="page-content">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-chart-area'></i> Upcoming task
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <span class="sparklines hidden-lg-down" sparkType="bar" sparkBarColor="#886ab5" sparkHeight="32px" sparkBarWidth="5px" values="3,4,3,6,7,3,3,6,2,6,4"></span>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-container show">
                    <div class="panel-content" style="margin-left:-15px;">
                        <!-- datatable start -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Taskname</th>
                                    <th>Descriptions</th>
                                    <th>Date</th>
                                    <th>Start_time</th>
                                    <th>End_time</th>
                                </tr>
                            </thead>
                            @foreach ($data as $task)
                            <tbody>
                                <tr>
                                    <td>{{ $task->taskname }}</td>
                                    <td>{{ $task->descriptions }}</td>
                                    <td>{{ $task->date }}</td>
                                    <td>{{ $task->start_time }}</td>
                                    <td>{{ $task->end_time }}</td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection