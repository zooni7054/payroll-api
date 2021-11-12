<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\User;

class ProfileController extends Controller
{

    public function profileUpdate(Request $request)
    {
        $user = auth()->user();

        if(!$user){
            return $this->sendError('User not found!');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:admins|unique:users,email,'.$user->id
        ]);

        if($validator->fails()){
            return $this->sendError('validation', $validator->errors());
        }

        $user = $user->update($request->all());

        return $this->sendResponse($user, 'Profile updated successfully!');
    }

}
