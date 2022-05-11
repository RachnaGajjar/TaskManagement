<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTask;
use Illuminate\Http\Request;

class EmployeeDashboardController extends Controller
{
    //
    public function UpcomingTask()
    {
        $user = auth()->user();
        $id = ($user->id);
        $currentDate = date("Y-m-d");
        $todaystask = EmployeeTask::whereHas('employee', function($query) use($user,$currentDate){
            $query->where('user_id',$user->id)->where('date',$currentDate);
        })->count();
        $employeeupcomingtask = EmployeeTask::whereHas('employee', function($query) use($user,$currentDate)
        {
            $query->where('user_id',$user->id)->where('date','>',$currentDate);
        })->count();

        $currentDate = date("Y-m-d");
        // $completetask = EmployeeTask::whereHas('employee', function($query) use($user,$currentDate)
        // {
        //     $query->where('user_id',$user->id)->where('status','=','Completed');
        // })->count();
        $completetask = EmployeeTask::with('employee')->where('status','=','Completed')->count();
        // dd($completetask);
        return view('Employeedashboardlayout.employeesdashboard',compact('todaystask','employeeupcomingtask','completetask'));
    }
}
