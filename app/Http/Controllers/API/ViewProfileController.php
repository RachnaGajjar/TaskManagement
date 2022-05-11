<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\viewProfile;
use Validator;
use App\Models\User;

class ViewProfileController extends BaseController
{
    //
    public function index($token)
    {
        $profile = User::find($token);
        dd($profile);
        return $this->sendResponse(viewProfile::collection($profile), 'Products retrieved successfully.');
        
    }
    
}
