<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeLeave;
use App\Models\EmployeeTask;
use App\Models\Organization;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function dashboardOfListing()
    {
        //Display Numberoforganization,Numberofemployee,Numberofpendingtask,Numberofpendingleaves.
        $Organization=Organization::all()->count();
        $Employee=Employee::all()->count();
        $Pendingtask=EmployeeTask::where('status','pending')->count();
        $Pendingleave=EmployeeLeave::where('status','pending')->count();
        return view('layout.dashboard',compact('Organization','Employee','Pendingtask','Pendingleave'));
    }
  
}