<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        
        // if(Auth::user()->usertype=='admin')
        // {
        //     //redirect to Admin's dashboard.
        //     return redirect('/dashboard');
        // }
        // else if(Auth::user()->usertype=='employee')
        // { 
        //     //redirect to Employee's dashboard.
        //     return redirect('employees/dashboard');
        // }

        return $next($request);
    }
}
