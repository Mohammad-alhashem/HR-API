<?php

namespace Modules\Hr\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


use Modules\Hr\Entities\Employees\Employee;
use Modules\Hr\App\Http\Requests\CreateMultipleEmployeesRequest;
use Modules\Hr\App\Http\Resources\EmployeeResource;
use App\Traits\ApiResponses;

class HrController extends Controller
{

    use ApiResponses;

    public function index()
    {

        $per_page       = request()->get('per_page') ? request()->get('per_page') : 2;
        $per_page       = is_numeric($per_page) && $per_page < 50 && $per_page > 0 ? $per_page : 10;

        $employees      = Employee::paginate($per_page);
        
        return $this->sendSuccess('list_of_employees', [
            'list'          => EmployeeResource::collection($employees),
            'pagination'    => $this->pagination($employees)
        ]);
    }

    public function create(CreateMultipleEmployeesRequest $request)
    {

        $employee = Employee::first();

    }
    
}