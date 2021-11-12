<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\User;

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

        if(auth()->guard('user')->attempt(['email' => $request->email, 'password' => $request->password])){
            $user = auth()->guard('user')->user();
            $data['token'] =  $user->createToken('UserToken')->plainTextToken;
            $data['user'] =  $user;
            $data['user']->role =  'user';
            return $this->sendResponse($data, 'User loggedin successfully.');
        }
        else{
            return $this->sendError('Unauthorized.', ['error'=>'Invalid email address or password!']);
        }
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return $this->sendResponse('', 'User logged out successfully.');
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users|unique:admins',
            'password' => 'required|max:20'
        ]);

        if($validator->fails()){
            return $this->sendError('validation', $validator->errors());
        }

        $user = User::create($request->all());

        return $this->sendResponse($user, 'Registered successfully!');
    }

    public function validateToken(Request $request){

        $user = auth()->user();
        $data['token'] =  auth()->user()->currentAccessToken()->token;
        $data['user'] =  $user;
        $data['user']->role =  'user';
        return $this->sendResponse($data, 'User validated successfully.');
    }
}
