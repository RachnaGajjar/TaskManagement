<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeLeave;
use App\Models\EmployeeTask;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class EmployeesleaveController extends Controller
{
    public function employeeleaveIndex(Request $request)
    {
        //Redirect to Employeeleave index page.
       return view('employeeLeaves.employeeLeaveIndex');
    }
    public function employeesleaveindexajax(Request $request, EmployeeLeave $employeeleave)
    {
        //Ajax call for display Employee's Own leaves.
        $user = auth()->user();
        $id = ($user->id);
        $data = EmployeeLeave::whereHas('users', function($query) use($user)
        {
            $query->where('id',$user->id);
        })->with('users')->get();
        return Datatables::of($data)
        ->make(true);
    }
    public function employeeleaveCreate()
    {
        $items = Employee::pluck('id', 'name');
        $leavestatus = ['Approved' => 'Approved' , 'Decline' => 'Decline' ,'pending' => 'pending',];
        return view('employeeLeaves.employeesLeave', compact('items','leavestatus'));
    }
    public function employeeleaveStore(Request $request)
    {
        //store employeeleaves
        $request->validate([
            'reason' => 'required',
            'leave_start_date' => 'required',
            'leave_end_date' => 'required',
            ]);
            $user = auth()->user();
            $id = ($user->id);
            $request['userid'] = $id;
        $employee = EmployeeLeave::create($request->all());
        return redirect()->route('employeesleave.employeeleaveIndex')
            ->with('success', 'Leave added successfully');
    }
   /*   public function employeesleaveshow($id, EmployeeLeave $employeesleave)
    {
        $items = Employee::pluck('name', 'id');
        $leavestatus = EmployeeLeave::pluck('status');
        $employeetask = EmployeeLeave::with('Employee')->latest()->where('id', $id)->first();
        return view('employeeLeaves.employeeLeaveShow', compact('employeetask', 'items','leavestatus'));
    }  */
   /*  public function employeesleaveEdit($id)
    {
        $items = Employee::pluck('name', 'id');
        $leavestatus = ['Approved' => 'Approved' , 'Decline' => 'Decline' ,'pending' => 'pending',];
        $employeeleave = EmployeeLeave::with('Employee')->latest()->where('id', $id)->first();

        return view('employeeLeaves.employeeLeaveEdit', compact('employeeleave', 'items', 'leavestatus'));
    }  */
    /* public function employeesleaveUpdate(Request $request, $id)
    {
        $request->validate([
            'emp_id' => 'required',
            'status' => 'required',
            'reason' => 'required',
            'date' => 'required',
            'leave_start_date' => 'required',
            'leave_end_date' => 'required',
        ]);
        $employeeleave = EmployeeLeave::with('Employee')->latest()->where('id', $id)->first();
        $employeeleave->update($request->all());
        return redirect()->route('employeesleave.employeeleaveIndex')->with('success', 'EmployeeLeave updated successfully');
    }  */
  /*    public function employeesleaveDestroy($id)
    {
        $employeeleave = EmployeeLeave::with('Employee')->latest()->where('id', $id)->first();
          $employeeleave->delete();
            return redirect()->route('employeesleave.employeeleaveIndex')
            ->with('success', 'employeetask deleted successfully');
    }  */
    public function employeeleaveAdminIndex()
    {
        return view('employeeLeaves.employeeLeaveAdminIndex');
    }
    public function Adminindexajax()
    {
        $data = EmployeeLeave::with('employee')->get();
        return Datatables::of($data)
        ->addColumn('action', function ($row) {
            if($row->status=='pending')
            {
            $actionbtn='<a id="' . $row->id . '" class="btn btn-primary approved" >Approved</a> <a id="' .$row->id . '" class="btn btn-danger decline">Decline</a>';
            return $actionbtn;
            }

        })->rawColumns(['action'])->make(true);
    }

    /*  public function employeeleaveAdminShow($id)
    {
        $items = Employee::pluck('name', 'id');
        $employeetask = EmployeeLeave::with('Employee')->latest()->where('id', $id)->first();
        //dd($employees);
        return view('employeeLeaves.employeeLeaveAdminShow', compact('employeetask', 'items'));
    }  */
    /* public function employeesleaveAdminEdit($id)
    {
        $items = Employee::pluck('name', 'id');
        $leavestatus = ['Approved' => 'Approved' , 'Decline' => 'Decline' ,'pending' => 'pending',];
        $employeeleave = EmployeeLeave::with('Employee')->latest()->where('id', $id)->first();
        return view('employeeLeaves.employeeLeaveAdminEdit', compact('employeeleave', 'items', 'leavestatus'));
    }  */
   /*   public function employeesleaveAdminUpdate(Request $request, $id)
    {
        $request->validate([


            'reason' => 'required',
            'leave_start_date' => 'required',
            'leave_end_date' => 'required',
        ]);

        $employeeleave = EmployeeLeave::with('Employee')->latest()->where('id', $id)->first();
        $employeeleave->update($request->all());
        return redirect()->route('employeeleaveAdminIndex')->with('success', 'EmployeeLeave updated successfully');
    }  */
    public function approvedajax(Request $request)
    {
        //Approved Leave ajax call
        $id=$request->leave_id;
        $status=$request->leave_status;
        $employee_task=EmployeeLeave::where('id',$id)->first();
        $employee_task->update(['status'=>$status]);

    }
    public function declinedajax(Request $request)
    {
        //Delined Leave ajax call
        $id=$request->leave_id;
        $status=$request->leave_status;
        $employee_status=EmployeeLeave::where('id',$id)->first();
        $employee_status->update(['status'=>$status]);
    }
    public function Resetpassword()
    {
        //Forgot Password
        $user = auth()->user();
        $email=($user->email);
        return view('EmployeeTasklist.resetpassword',compact('email'));

    }
    public function employeeProfile(Request $request)
    {
       //Display Employee & Admin Profile
       $user = auth()->user();
        $profile = User::where('id', $user->id)->first();
        $image = url('').'/'.'upload'.'/'.'images'.'/'. $profile->image;
        //$image = $profile->image ('second way');
        return view('EmployeeTasklist.profile',compact('profile','image'));

    }
    public function upload(Request $request)
    {

        //Image upload for Employee Profile.
        if($request->has('images')) {
            $file = $request->file('images');
            $file_name = time() .'.'. $file->getClientOriginalExtension();
            $file_path = 'upload/images';
            $file->move($file_path, $file_name);
            $image = url('').'/'.$file_path.'/'.$file_name;

        }
        $user = auth()->user();
        $profile = User::find($user->id);
        $profile->image  = $image;
        $profile->save();
        return back()->with('success','You have successfully upload image.');
    }

}
