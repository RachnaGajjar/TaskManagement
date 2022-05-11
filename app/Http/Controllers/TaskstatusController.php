<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeTask;
use Illuminate\Http\Request;

class TaskstatusController extends Controller
{
    public function employeeTaskTodayTask()
    {
        //display today's task of the employees.
        $user = auth()->user();
        $id = ($user->id);
        $currentDate = date("Y-m-d");
        $taskstatus = [
            'Pending' => 'Pending', 'In Progress' => 'In Progress', 'Completed' => 'Completed'
        ];
        $data = EmployeeTask::whereHas('employee', function ($query) use ($user, $currentDate) {
            $query->where('user_id', $user->id)->where('date', $currentDate);
        })->get();
        return view('EmployeeTasklist.todayTask', compact('data', 'taskstatus'));
    }
    public function taskstatus(Request $request)
    {
        //task status of the employees which is changeable by employees like status is pending change to Completed.
        $id = $request->task_id;
        $status = $request->status;
        $employee_task = EmployeeTask::where('id', $id)->first();
        $employee_task->update(['status' => $status]);
    }
    public function employeeTaskUpcomingTask()
    {
        //display upcoming(future task which assign to employee)
        $user = auth()->user();
        $id = ($user->id);
        $currentDate = date("Y-m-d");
        $data = EmployeeTask::whereHas('employee', function ($query) use ($user, $currentDate) {
            $query->where('user_id', $user->id)->where('date', '>', $currentDate);
        })->get();
        return view('EmployeeTasklist.upcomingTask', compact('data'));
    }
    public function employeeTaskPastTask()
    {
        //This function is for display all the pasttask which is assign to employees.
        $user = auth()->user();
        $id = ($user->id);
        $currentDate = date("Y-m-d");
        $data = EmployeeTask::whereHas('employee', function ($query) use ($user, $currentDate) {
            $query->where('user_id', $user->id)->where('date', '<=', $currentDate);
        })->get();
        return view('EmployeeTasklist.pastTask', compact('data'));
    }
    public function verifyuser($token)
    {
        //Email verification For Email if employees status is active access for login otherwise it will not login access.
        $verifieduser = Employee::where('token', $token)->first();
        if (isset($verifieduser)) {
            $userstatus = $verifieduser->status;
            if ($verifieduser->status == 'In-active') {

                $verifieduser->status = 'active';
                $verifieduser->save();

                $status = "Your e-mail is verified. You can now login.";
            } 
            else 
            {
                return redirect('/')->with('warning', "Sorry your email cannot be identified.");
            }
        } 
        else 
        {
            $status = "Your e-mail is already verified. You can now login.";
        }
        return redirect('/')->with('status', $status);
    }
}
