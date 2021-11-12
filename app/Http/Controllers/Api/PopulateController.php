<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use URL;

class PopulateController extends Controller
{

    public $model;

    /**
     * Class constructor.
     */
    public function __construct(Request $request)
    {
        $this->middleware(['auth:sanctum', 'auth:admin-api'])->except('index', 'show');

        $this->model = $this->getModel($request);
    }

    // assign model
    public function getModel($request){
        $route = explode(".", $request->route()->getName());

        switch ($route[0]) {
            case 'employment-types':
                return 'App\Models\EmploymentType';
                break;
            case 'employee-statuses':
                return 'App\Models\EmployeeStatus';
                break;
            case 'company-types':
                return 'App\Models\CompanyType';
                break;
            case 'departments':
                return 'App\Models\Department';
                break;
            case 'allowance-categories':
                return 'App\Models\AllowanceCategory';
                break;
            case 'contribution-categories':
                return 'App\Models\ContributionCategory';
                break;
            case 'deduction-categories':
                return 'App\Models\DeductionCategory';
                break;
            case 'document-categories':
                return 'App\Models\DocumentCategory';
                break;
            case 'payment-methods':
                return 'App\Models\PaymentMethod';
                break;
            case 'pay-types':
                return 'App\Models\PayType';
                break;
            case 'relationship-types':
                return 'App\Models\RelationshipType';
                break;
            case 'cities':
                return 'App\Models\City';
                break;
            case 'states':
                return 'App\Models\State';
                break;
            case 'info-types':
                return 'App\Models\InfoType';
                break;
            case 'roles':
                return 'App\Models\Role';
                break;

            default:
                return 'App\Models\EmploymentType';
                break;
        }

        // return 'App\Models\EmploymentType';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $page = 15;

        $query = new $this->model;

        if(!empty($request->name)){
            $query = $query->where('name', 'like', '%'.$request->name.'%');
        }

        // sorting
        if($request->has('sort')){
            if($request->has('order')){
                $query = $query->orderBy($request->sort, $request->order);
            }
            else{
                $query = $query->orderBy($request->sort, 'ASC');
            }
        }

        // pagination
        if($request->has('perpage')){
            if($request->perpage > 1){
                $page = $request->perpage;
            }
        }

        $data = $query->paginate($page);

        return $this->sendResponse($data, 'Data retrieved successfully!');
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
            'name' => 'required|max:100'
        ]);

        if($validator->fails()){
            return $this->sendError('validation', $validator->errors());
        }

        $data = new $this->model;

        $data = $data->create($request->all());

        return $this->sendResponse($data, 'Data stored successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = new $this->model;
        $data = $query->find($id);

        if($data){
            return $this->sendResponse($data, 'Data retrieved successfully!');
        }

        return $this->sendError('Data not found!');
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

        $query = new $this->model;
        $data = $query->find($id);

        if(!$data){
            return $this->sendError('User not found!');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100'
        ]);

        if($validator->fails()){
            return $this->sendError('validation', $validator->errors());
        }

        $data = $data->update($request->all());

        return $this->sendResponse($data, 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $query = new $this->model;
        $data = $query->find($id);

        if(!$data){
            return $this->sendError('Data not found!');
        }

        $data = $data->delete();

        return $this->sendResponse('', 'Data deleted successfully!');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $query = new $this->model;
        $data = $query->withTrashed()->find($id);

        if(!$data){
            return $this->sendError('Data not found!');
        }

        $data = $data->restore();

        return $this->sendResponse('', 'Data restore successfully!');
    }
}
