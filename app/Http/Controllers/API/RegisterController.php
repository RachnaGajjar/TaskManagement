<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;


class RegisterController extends BaseController
{
    //
    public function register(Request $request)
    {

      /*   $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiY2UwNTI1M2NlOTcwODRhYzdmNzA3NGNmNzYxYWQ3YjkxYmFlMGYxYzA2NDA0MGQxNGU4MWViMDJjYzRiNTQyOTBkYzc5ODE3ZTRmZjUyMmIiLCJpYXQiOjE2Mzc1NjQyNjAuNTg2MDcxLCJuYmYiOjE2Mzc1NjQyNjAuNTg2MDc4LCJleHAiOjE2NjkxMDAyNjAuNTczMzUyLCJzdWIiOiIxMjIiLCJzY29wZXMiOltdfQ.SCT-SJg39nSsWrV5Iwb7b5YwbSt32JWO-w5B66t0w64IqgBjEibNkqVxtBBAZjMYa6pMw2AY5PMCMvJbVL45y1CckMlY2vGszVjWKr3k4rlMk-hlEQE3srqszf4QiEjQIWEEfEHM_lmZsUlQC6fkev48rj3pz5cDzr4enRDPofR3wzrw3Vsd5sR_JrPnBNYD4udDraVZz62IOsmoS7cfZRlMCJ5PhY-HNcQw7aQTYGl7h9XuggyhDKLhM-4TuRiB-nWTH6-FHXE7lL9AYVIATezUMcUsS5VZ496zVUUjwL0R8ShzpVZjvbTetu57TOEhu2G7qe1i6umY-c__ppuS7lLs3dWUoi2IwwN48W5-Pi8q-hX2eDpJWppv9agMA6lNS3_MsZMW8N1vfJCXJaVcXNhou7Ni7PdfBGXnvZC30BCRmewUeXPYa-w4pCM8ZyHh1YGMY1NUAjFXna4tzYsqUBOTFcjdX8xD3m5vOzqZfH5XqzNX2_GB-yWcoMMVhE9A5xkINTd4JlXM8-j-NVVHer66yBY00Njz-sAGgSEb8756OGdW0fCEaF9ALluQMy6zF5qdE_c-_AHz8uXkG8znBZChHd45KJPJSZTPOPVoBs6QUU4UZIlEyiPgjoBZVTxKg2oe2b48nrf71kjfSS0AUbfRixs4kM5ygVFivVDqFjM";
        $tokenParts = explode(".", $token);
        $tokenHeader = base64_decode($tokenParts[0]);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtHeader = json_decode($tokenHeader);
    $jwtPayload = json_decode($tokenPayload);
print_r($jwtHeader);
print_r($jwtPayload); */

         $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'retypepassword' => 'required|same:password',
            'usertype'=>'required',

        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        try
        {
            $user = User::create($input);
        }
       catch (\Exception $e) {
           return $this->sendError('Email is already exist .');
       }

        $success['token'] =  $user->createToken('Employee_Task_Mangement_System')->accessToken;
        $user->createToken=$success['token'];
        $user->save();
        return $this->sendResponse($success, 'User register successfully.');
    }
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('Employee_Task_Mangement_System')-> accessToken;
            $success['name'] =  $user->name;
            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

}
