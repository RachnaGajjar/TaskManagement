<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeLeave;
use App\Models\EmployeeWorkingTime;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {


        return view('employees.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexAjax(Request $request, Employee $employee)
    {
        //this function used for display yajra's datatable with all the records of db.
        $data = Employee::with('organization')->get();
         return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<a href="/employees/' . $row->id . '/edit" class="btn btn-warning">Edit</a>';
            })

            ->addColumn('show', function ($row) {
                return '<a href="/employees/' . $row->id . '" class="btn btn-primary">Show</a>';
            })

            ->addColumn('delete', function ($row) {
                return '<a id="' . $row->id . '" class="btn btn-danger action-btn deleteCat" data-toggle="modal" title="Delete" data-target="#deleteModal" data-original-title="Delete">Delete</a>';
            })
            ->rawColumns(['show', 'delete', 'action'])->make(true);

    }

    public function create()
    {
        //pluck id and name for dropdown and send data to create page.
        $items = organization::pluck('name', 'id');
        $employeestatus='In-active';
        $selectedID = 2;
        return view('employees.create', compact('items','employeestatus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //perform validation and store data with the help of this mehod and send mail to employee.
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phonenumber' => 'required',
            'org_id' => 'required',
            'address' => 'required',
            'emergencycontact' => 'required',
            'status'=>'required',

        ]);

        $normalPass = $request->input('password');
        $password = Hash::make($request->input('password'));
        $request['password'] = $password;
        try {

            $user = User::create(['email' => $request->input('email'), 'password' => $password, 'usertype' => 'employee']);
            $user_id = $user->id;
            $request['user_id'] = $user_id;
            $token = Str::random(64);
            $request['token']=$token;
            $employee = Employee::create($request->all());
            $employee->password = $normalPass;
            $employee->email = $request->input('email');
            $details = [
                'title' => 'Employee Created',
                'name'=>$employee['name'],
                'email' => $employee['email'],
                'password'=>$employee['password'],
                'token'=>$employee['token']
            ];
            //send mail
            Mail::to($request->email)->send(new \App\Mail\EmployeeCreatedMail($details));
            return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                return back()->with('error', 'Please check your email and phone number must be unique.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($employee_id, EmployeeWorkingTime $EmployeeWorkingTime, Request $request)
    {
        $employee=Employee::with('user')->where('id',$employee_id)->first();

        //show perticular record from the table.
        $datadropdown = [
            '' => 'select time', '00:00' => '12 AM', '01:00' => '1 AM', '02:00' => '2 AM', '03:00' => '3 AM', '04:00' => '4 AM', '05:00' => '5 AM', '06:00' => '6 AM', '07:00' => '7 AM',
            '08:00' => '8 AM', '09:00' => '9 AM', '10:00' => '10 AM', '11:00' => '11 AM', '12:00' => '12 PM',
            '13:00' => '1 PM', '14:00' => '2 PM', '15:00' => '3 PM', '16:00' => '4 PM',
            '17:00' => '5 PM', '18:00' => '6 PM', '19:00' => '7 PM', '20:00' => '8 PM',
            '21:00' => '9 PM', '22:00' => '10 PM', '23:00' => '11 PM'
        ];
        $working_time = DB::table('employee_working_time')
            ->select('day', 'start_time', 'end_time')
            ->where('emp_id', $employee->id)
            ->get();

        $time_arr = [];
        foreach ($working_time as $keys => $times) {
            // echo $keys."  ||  ".$times->day."<br>";
            $time_arr['days'] = $times;
            $time_arr[$times->day] = ["start_time" => $times->start_time, "end_time" => $times->end_time];
        }
            return view('employees.show', compact('employee', 'datadropdown', 'time_arr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Employee $employee)
    {
        //preselected edit form to edit data.
        $items = organization::pluck('name', 'id');
        $selectedID = 2;
        return view('employees.edit', compact('employee', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Employee $employee ,User $users)
    {
        //check validation and after that update the value and store it.
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'org_id' => 'required',
            'address' => 'required',
            'emergencycontact' => 'required',
            'email'=>'required',
        ]);
        //dd($request->all());
        $email=$employee->user->email;
        $id=$employee->user_id;
       // dd($id);
        $emailid = $request->input('email');
        if($email != $emailid)
        {
            $user=User::find($id);
            $user->email=$emailid;
            $user->save();
            $EditEmployee = [
                'title' => 'Employee Email Edited',
                'name'=>$employee['name'],
                'email' => $user['email'],
                ];
                //dd($EditEmployee);
            //send mail
            Mail::to($request->email)->send(new \App\Mail\EditEmployeeMail($EditEmployee));
            return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully');

        }
        else
        {
            $employee->update($request->all());
            //dd($employee);
            return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully');
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Employee $employee)
    {
        //delete employee with help of id.
        $employee->delete();
        return redirect()->route('employees.index')
            ->with('success', 'organization deleted successfully');
    }

    public function workingHours(Request $request, Employee $employee, EmployeeWorkingTime $employeeWorkingTime)
    {
        $employee_id = $request->input('emp_id');
        $times = $request->input('time');
        foreach ($times as $key => $time) {
            $a['emp_id'] = $employee_id;
            $a['day'] = $key;
            if (($time['start_time'] != null && $time['end_time'] != null) || (!empty($time['start_time']) && !empty($time['end_time']))) {
                $a['start_time'] = $time['start_time'];
                $a['end_time'] = $time['end_time'];

            } else {
                // echo "hi".$key."<br>";
                continue;
            }
                $getid = $a['emp_id'];
                $getday = $a['day'];
                //dd($request->all());
                $data = EmployeeWorkingTime::where('emp_id', $getid)->where('day', $getday)->first();
                if (empty($data))
                {
                    $employee = EmployeeWorkingTime::create($a);

                } else {

                    $employee = $data->update($a);
                }
            }
            return redirect('/employees/')->with('success', 'Employee created successfully.');
            }

    }












