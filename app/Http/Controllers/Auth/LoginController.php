<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        /* $this->middleware('guest:users')->except('logout');
        $this->middleware('guest:employees')->except('logout');
    } */
    }
    public function login(Request $request)
    {
        //get email and password and check validation
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',

        ]);
       //with help of authencation method check email and password is verified or not
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {

            /* return redirect('/dashboard')->with('success','Login Successfully');


            if(Auth::user()->usertype=='admin')
            {
                //redirect to Admin's dashboard.
                return redirect('/dashboard')->with('success','Login Successfully');
            }
            else if(Auth::user()->usertype=='employee')
            {
                //redirect to Employee's dashboard.
                return redirect('employees/dashboard')->with('success','Login Successfully');
            }
            return redirect('/dashboard')->with('success','Login Successfully');
        }
        else
        {
            return redirect('/')
            //redirect to login page.
                ->with('error','Email-Address And Password Are Wrong.');
        } */


        if (auth()->user()->usertype == 'admin')
        {

            return redirect('/dashboard')->with('success','Login Successfully');
        }
        else
        {

            return redirect('employees/dashboard')->with('success','Login Successfully');
        }
        }
        else
        {
            return redirect('/')->with('error','Email-Address And Password Are Wrong.');
        }

    }



}
