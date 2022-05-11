<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeLeave;
use App\Models\EmployeeTask;
use App\Models\EmployeeWorkingTime;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class EmployeetaskController extends Controller
{
    //
    public function employeesTaskIndex(Request $request, EmployeeTask $employeetask)
    {
        return view('employeesTask.employeesindex');
    }
    public function employeesTaskindexAjax(Request $request, EmployeeTask $employeetask)
    {
        $data = EmployeeTask::with('employee')->get();
        
        return Datatables::of($data)
            
            ->addColumn('show', function ($row) {
                return '<a href="' . route('employees.taskShow', $row->id) . '" class="btn btn-primary">Show</a>';
            })
            ->addColumn('delete', function ($row) {
                return '<a id="' . $row->id . '" class="btn btn-danger action-btn deleteCat" data-toggle="modal" title="Delete" data-target="#deleteModal" data-original-title="Delete">Delete</a>';
            })
            ->addColumn('action', function ($row) {
                return '<a href="' . route('employees.taskEdit', $row->id) . '" class="btn btn-warning">Edit</a>';
            })
            ->rawColumns(['show', 'delete', 'action'])->make(true);
    }
    public function employeesTaskCreate()
    {
        $items = Employee::pluck('id', 'name');
        $taskstatus = [
            'Completed'=> 'Completed','inprogress' => 'inprogress','pending' => 'pending'];
        return view('employeesTask.employeetask', compact('items','taskstatus'));

    }
    public function employeesTaskStore(Request $request,EmployeeLeave $employeeLeave)
    {
        $request->validate([
            
            'taskname' => 'required',
            'descriptions' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',

        ]);
        $id = $request->input('emp_id');
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');
        $userid=$request->input('');
        $days = date('l', strtotime($request->input('date')));
        $day = Str::lower($days);
        $checkdate=$request->input('date');
        $data=$employeeLeave->userid;
        $userid=Employee::where('id',$id)->select('user_id')->first();
        $checkuser=EmployeeLeave::where('userid',$userid)->where('leave_start_date',$checkdate)->orwhere('leave_end_date',$checkdate)->first();
        $employeecheckDay = EmployeeWorkingTime::where('emp_id', $id)->where('day', $day)->first();
        $employeecheckTime = EmployeeWorkingTime::where('emp_id', $id)->where('start_time', '<=', $start_time)->where('end_time', '>=', $end_time)->first();
       // dd($checkuser,$employeecheckDay,$employeecheckTime);
            if ($employeecheckDay != null && $employeecheckTime != null) 
            {
                EmployeeTask::create($request->all());
                //dd('hello');
                return redirect('employeestask/index')->with('success', 'Employee created successfully.');
            } 
            else {
           
            //dd('sorry');
            return redirect('employeestask/index')->with('error', 'Employee is not avilable for this time.');
        }
    }
    public function employeesTaskShow($id, EmployeeTask $employeetask)
    {
        $items = Employee::pluck('name', 'id');
        $employeetask = EmployeeTask::with('Employee')->latest()->where('id', $id)->first();
        //dd($employees);
        return view('employeesTask.employeetaskshow', compact('employeetask', 'items'));
    }
    public function employeesTaskEdit($id, EmployeeTask $employeetask)
    {
        $items = Employee::pluck('name', 'id');
        $employeetask = EmployeeTask::with('Employee')->latest()->where('id', $id)->first();
        // dd($employeetask);
        return view('employeesTask.employeetaskedit', compact('items', 'employeetask'));
    }
    public function employeesTaskUpdate(Request $request, $id, EmployeeTask $employeetask)
    {
        $request->validate([
            'emp_id' => 'required',
            'taskname' => 'required',
            'descriptions' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        $employeetask = EmployeeTask::with('Employee')->latest()->where('id', $id)->first();
        //dd($employeetask);
        $employeetask->update($request->all());
        return redirect()->route('employees.task')
            ->with('success', 'Employeetask updated successfully');
    }
    public function employeesTaskDestroy($id, EmployeeTask $employeetask)
    {
        //delete employeetask with help of id.
        $employeetask = EmployeeTask::with('Employee')->latest()->where('id', $id)->first();
        $employeetask->delete();
            return redirect()->route('employees.task')
            ->with('success', 'employeetask deleted successfully');
      
    }
    
    
}
