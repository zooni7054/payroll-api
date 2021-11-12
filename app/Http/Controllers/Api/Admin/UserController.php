<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = new User;

        if(!empty($request->name)){
            $query = $query->where('name', 'like', '%'.$request->name.'%');
        }

        $user = $query->orderBy('id', 'DESC')->paginate(15);

        return $this->sendResponse($user, 'User data retrieved successfully!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users|unique:admins',
            'password' => 'required|max:20'
        ]);

        if($validator->fails()){
            return $this->sendError('validation', $validator->errors());
        }

        $user = User::create($request->all());

        return $this->sendResponse($user, 'User stored successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if($user){
            return $this->sendResponse($user, 'User retrieved successfully!');
        }

        return $this->sendError('User not found!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::find($id);

        if(!$user){
            return $this->sendError('User not found!');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:admins|unique:users,email,'.$id
        ]);

        if($validator->fails()){
            return $this->sendError('validation', $validator->errors());
        }

        $user = $user->update($request->all());

        return $this->sendResponse($user, 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if(!$user){
            return $this->sendError('User not found!');
        }

        $user->delete();

        return $this->sendResponse('', 'User deleted successfully!');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $user = User::withTrashed()->find($id);

        if(!$user){
            return $this->sendError('User not found!');
        }

        $user->restore();

        return $this->sendResponse('', 'User restore successfully!');
    }
}
