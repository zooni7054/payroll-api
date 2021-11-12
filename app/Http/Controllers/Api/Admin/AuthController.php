<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Model\PersonalAccessToken;
use App\Models\Admin;
use Hash;
use Auth;

class AuthController extends Controller
{
    /**
     * Login to application.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('validation', $validator->errors());
        }

        $credentials = $request->only('email', 'password');

        if(auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
            $user = auth()->guard('admin')->user();
            $data['token'] =  $user->createToken('StaffToken')->plainTextToken;
            $data['user'] =  $user;
            $data['user']->role =  'staff';
            return $this->sendResponse($data, 'User logged in successfully.');
        }
        else{
            return $this->sendError('Invalid email address or password.', ['error'=>'Invalid email address or password'], 200);
        }
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return $this->sendResponse('', 'User logged out successfully.');
    }

    public function validateToken(Request $request){

        $user = auth()->user();
        $data['user'] =  $user;
        $data['user']->role =  'staff';
        return $this->sendResponse($data, 'User validated successfully.');
    }
}
