<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Stripe;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Profile as viewProfile;
use App\Models\Carddetail;
use App\Models\Employee;
use Dotenv\Validator as DotenvValidator;
use GrahamCampbell\ResultType\Success;
use Illuminate\Database\Console\Migrations\RollbackCommand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Token;

class ProfileController extends BaseController
{
    public function show()
    {
        $profile = auth::user();
        return new viewProfile($profile);
    }
    public function update(Request $request, User $user)
    {
        //upadte profile API
        $input = $request->all();
        $validator = Validator::make($input, [
            'email' => 'required',
            'usertype' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $profile = auth::user();
        $id = $profile->id;
        $user = User::find($id);
        if ($user) {
            $user->email = $input['email'];
            $user->usertype = $input['usertype'];
            $user->save();
        }

        return response()->json([
            "success" => true,
            "message" => "update successfully uploaded",
        ]);
    }




    public function TransactionalAPI(Request $request, User $user)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'email' => 'required',
            'usertype' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        DB::beginTransaction();
        try {
            $profile = auth::user();
            $id = $profile->id;
            //User::create($input);
            $user = User::find($id);
            if ($user) {
                $user->email = $input['email'];
                $user->usertype = $input['usertype'];
                $user->save();

                $user->email1 = $input['email'];
                $user->save();
                DB::commit();
                return response()->json([
                    "success" => true,
                    "message" => "update successfully uploaded",
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }
}
