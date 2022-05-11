<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Resources\Profile;
use App\Http\Controllers\API\ProfileController;
use Doctrine\DBAL\Schema\Index;
use App\Http\Controllers\API\FileUploadController;
use App\Http\Controllers\API\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('hii', function(){
//     dd(1);
// });


 /*  Route::middleware('auth:api')->get('/user', function (Request $request)
 {
     return $request->user();

});  */
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
Route::post('forgot',[ForgotPasswordController::class,'forgot']);
/* Route::resource('Profile', ProfileController::class);  */

Route::post('uploading-file-api', [FileUploadController::class, 'upload']);

Route::middleware('auth:api')->group(function ()
{

    Route::resource('Profile', ProfileController::class);
    Route::post('TransactionalAPI', [ProfileController::class, 'TransactionalAPI']);
    Route::post('carddetails', [ProfileController::class, 'carddetails']);
    Route::post('userscard',[ProfileController::class,'UsersCards']);



});
