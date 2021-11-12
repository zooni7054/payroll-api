<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Admin;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = new Admin;

        if(!empty($request->name)){
            $query = $query->where('name', 'like', '%'.$request->name.'%');
        }

        $staff = $query->orderBy('id', 'DESC')->paginate(15);

        return $this->sendResponse($staff, 'Staff data retrieved successfully!');
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

        $staff = Admin::create($request->all());

        return $this->sendResponse($staff, 'Staff data stored successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff = Admin::find($id);

        if($staff){
            return $this->sendResponse($staff, 'Staff data retrieved successfully!');
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

        $staff = Admin::find($id);

        if(!$staff){
            return $this->sendError('User not found!');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users|unique:admins,email,'.$id
        ]);

        if($validator->fails()){
            return $this->sendError('validation', $validator->errors());
        }

        $staff = $staff->update($request->all());

        return $this->sendResponse($staff, 'Staff data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = Admin::find($id);

        if(!$staff){
            return $this->sendError('User not found!');
        }

        $staff->delete();

        return $this->sendResponse('', 'Staff data deleted successfully!');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $staff = Admin::withTrashed()->find($id);

        if(!$staff){
            return $this->sendError('User not found!');
        }

        $staff->restore();

        return $this->sendResponse('', 'Staff data restore successfully!');
    }
}
