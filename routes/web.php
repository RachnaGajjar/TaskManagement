<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    /* Route::group(['middleware' => 'is_admin'], function ()
    { });  */
    /* Route::group(['middleware' => 'auth:employees'], function () {
        Route::get('/employees/dashboard', function () {
            return view('Employeedashboardlayout.employeesdashboard');
        })->name('employee.dashboard');}); */
/*      Route::group(['guard' => 'auth'], function ()
    { */

        Route::get('/', function () {
            return view('layout.login');
        })->name('login.page');

        Auth::routes(['verify' => true]);
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::post('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('admin.login');

        //Admin and EmployeeDashboard
        Route::get('/dashboard', [App\Http\Controllers\AdminDashboardController::class, 'dashboardOfListing'])->name('dashboard')->middleware('guest');
        Route::get('/employees/dashboard', [App\Http\Controllers\EmployeeDashboardController::class,'UpcomingTask'])->name('employee.dashboard');

        //OrganizationRoute
        Route::resource('organizations', App\Http\Controllers\OrganizationController::class);
        Route::post('organizations/indexAjax', [App\Http\Controllers\OrganizationController::class, 'indexAjax'])->name('organizations.indexAjax');

        //EmployeesRoute
        Route::resource('employees', EmployeesController::class);
        Route::post('employees/indexAjax', [App\Http\Controllers\EmployeesController::class, 'indexAjax'])->name('employees.indexAjax');
        Route::post('employees/workingHours', [App\Http\Controllers\EmployeesController::class, 'workingHours'])->name('employees.workingHours');
        Route::put('employees/workingHours',[App\Http\Controllers\EmployeesController::class,'updateWorkingHours'])->name('employees.updateWorkingHours');

        //EmployeetaskRoute
        Route::get('employeestask/index',[App\Http\Controllers\EmployeetaskController::class,'employeesTaskIndex'])->name('employees.task');
        Route::post('employeestask/indexAjax', [App\Http\Controllers\EmployeetaskController::class, 'employeesTaskindexAjax'])->name('employeesTaskindexAjax');
        Route::get('employeestask/create',[App\Http\Controllers\EmployeetaskController::class,'employeesTaskCreate'])->name('employees.taskCreate');
        Route::post('employeestask/store',[App\Http\Controllers\EmployeetaskController::class,'employeesTaskStore'])->name('employees.taskStore');
        Route::get('employeestask/show/{id}',[App\Http\Controllers\EmployeetaskController::class,'employeesTaskShow'])->name('employees.taskShow');
        Route::get('employeetask/edit/{id}',[App\Http\Controllers\EmployeetaskController::class,'employeesTaskEdit'])->name('employees.taskEdit');
        Route::put('employeestask/update/{id}',[App\Http\Controllers\EmployeetaskController::class,'employeesTaskUpdate'])->name('employees.taskUpdate');
        Route::delete('employeetask/delete/{id}',[App\Http\Controllers\EmployeetaskController::class,'employeesTaskDestroy'])->name('employees.taskDestroy');

        //EmployeeLeaveRoutes
        Route::get('employeeleave/index',[App\Http\Controllers\EmployeesleaveController::class,'employeeleaveIndex'])->name('employeesleave.employeeleaveIndex');
        Route::post('employeesleave/indexAjax', [App\Http\Controllers\EmployeesleaveController::class, 'employeesleaveindexajax'])->name('employeesleave.indexAjax');
        Route::get('employeeleave/create',[App\Http\Controllers\EmployeesleaveController::class,'employeeleaveCreate'])->name('employeesleave.employeeleaveCreate');
        Route::post('employeeleave/store',[App\Http\Controllers\EmployeesleaveController::class,'employeeleaveStore'])->name('employeesleave.employeeleaveStore');
        /* Route::get('employeeleave/show{id}',[App\Http\Controllers\EmployeesleaveController::class,'employeesleaveshow'])->name('employeesleave.employeeleaveShow'); */
        /* Route::get('employeesleave/edit{id}',[App\Http\Controllers\EmployeesleaveController::class,'employeesleaveEdit'])->name('employeesleave.employeeleaveEdit'); */
        /* Route::put('employeesleave/update/{id}',[App\Http\Controllers\EmployeesleaveController::class,'employeesleaveUpdate'])->name('employeesleave.employeeleaveUpdate'); */
        /* Route::delete('employeeleave/delete/{id}',[App\Http\Controllers\EmployeesleaveController::class,'employeesleaveDestroy'])->name('employeesleave.employeeleaveDestroy'); */

        //AdminLeavelistRoutes
        Route::get('employeeleave/AdminIndex',[App\Http\Controllers\EmployeesleaveController::class,'employeeleaveAdminIndex'])->name('employeeleaveAdminIndex');
        Route::post('employeesleave/Adminindexajax', [App\Http\Controllers\EmployeesleaveController::class, 'Adminindexajax'])->name('Adminindexajax');
        Route::post('/approvedajax',[App\Http\Controllers\EmployeesleaveController::class,'approvedajax']);
        Route::post('declinedajax',[App\Http\Controllers\EmployeesleaveController::class,'declinedajax']);
        Route::post('/taskstatus',[App\Http\Controllers\TaskstatusController::class,'taskstatus']);

        //EmployeetasklistRoute
        Route::post('/taskstatus',[App\Http\Controllers\TaskstatusController::class,'taskstatus']);
        Route::get('employeetasklist/todaytask',[App\Http\Controllers\TaskstatusController::class,'employeeTaskTodayTask'])->name('employeeTaskTodayTask');
        Route::get('employeetasklist/Upcomingtask',[App\Http\Controllers\TaskstatusController::class,'employeeTaskUpcomingTask'])->name('employeeTaskUpcomingTask');
        Route::get('employeetasklist/Pasttask',[App\Http\Controllers\TaskstatusController::class,'employeeTaskPastTask'])->name('employeeTaskPastTask');

        //Employee and Admin ProfileRoute
        Route::get('employee/profile',[App\Http\Controllers\EmployeesleaveController::class,'employeeProfile'])->name('employeeprofile');
        Route::post('/employee/profile/image',[App\Http\Controllers\EmployeesleaveController::class,'upload'])->name('imageupload');

    /*  Route::get('employeeleave/AdminShow{id}',[App\Http\Controllers\EmployeesleaveController::class,'employeeleaveAdminShow'])->name('employeeleaveAdminShow');
        Route::get('employeesleave/Adminedit{id}',[App\Http\Controllers\EmployeesleaveController::class,'employeesleaveAdminEdit'])->name('employeesleave.employeeleaveAdminEdit');
        Route::put('employeesleave/Adminupdate/{id}',[App\Http\Controllers\EmployeesleaveController::class,'employeesleaveAdminUpdate'])->name('employeesleave.employeeleaveAdminUpdate');}); */


        //ForgotpasswordRoute
        Route::post('forget-password', [App\Http\Controllers\ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
        Route::get('reset-password/{token}', [App\Http\Controllers\ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
        Route::post('reset-password', [App\Http\Controllers\ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
        Route::get('/user/verify/{token}',[App\Http\Controllers\TaskstatusController::class,'verifyuser']);
        Route::get('forget-password', [App\Http\Controllers\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');

        //Googlelogin Route
        Route::get('auth/google', [App\Http\Controllers\GoogleController::class, 'redirectToGoogle'])->name('redirectToGoogle');
        Route::get('auth/google/callback', [App\Http\Controllers\GoogleController::class, 'handleGoogleCallback'])->name('handleGoogleCallback');

        //listerner
        Route::get('/event', [EventController::class, 'index'])->name('event.index');

        //Payment Gateway(Stripe)

        Route::get('Addcards', [App\Http\Controllers\StripePaymentController::class, 'addcards'])->name('addcards');
        Route::post('Addcards', [App\Http\Controllers\StripePaymentController::class, 'addcardspost'])->name('addcards.post');
        Route::get('paymentprocess',[App\Http\Controllers\StripePaymentController::class,'paymentprocess'])->name('paymentprocess');
        Route::post('postpaymentprocess',[App\Http\Controllers\StripePaymentController::class,'postpaymentprocess'])->name('postpaymentprocess');
