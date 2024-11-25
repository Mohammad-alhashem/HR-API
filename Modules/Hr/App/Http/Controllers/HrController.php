<?php

namespace Modules\Hr\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Hr\Entities\Employees\Employee;
use Modules\Hr\App\Http\Requests\CreateMultipleEmployeesRequest;
use Modules\Hr\App\Http\Resources\EmployeeResource;
use App\Traits\ApiResponses;
use App\Traits\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Hr\App\Jobs\SendEmployeeWelcomeEmail;

class HrController extends Controller
{
    use ApiResponses, Helper;

    public function index()
    {
        // get per_page from request and check if it is valid
        $per_page           = $this->checkPageNumber(request()->get('per_page'));
        $employees          = Employee::paginate($per_page);

        // return list of employees with pagination using EmployeeResource
        return $this->sendSuccess('list_of_employees', [
            'list'          => EmployeeResource::collection($employees),
            'pagination'    => $this->pagination($employees)
        ]);
    }

    public function create(CreateMultipleEmployeesRequest $request)
    {
        // get current timestamp for created_at
        $timestamp              = Carbon::now()->toDateTimeString();

        // create employees array to insert with created_at timestamp
        $employees              = collect($request->employees ?? [])->map(function($employee) use($timestamp){
            return [
                'first_name'    => $employee['first_name'],
                'last_name'     => $employee['last_name'],
                'email'         => $employee['email'],
                'created_at'    => $timestamp
            ];
        })->toArray();

        try {
            DB::transaction(function () use ($employees) {
                Employee::insert($employees);
            }, 3);
        } catch (\Exception $e)
        {
            return $this->sendError(500, 'error_creating_employees', [$e->getMessage()], []);
        }

        // use queue to send welcome email
        foreach($employees as $employee){
            SendEmployeeWelcomeEmail::dispatch($employee);
        }
        
        // return success message
        return $this->sendSuccess('employees_created',[]);
    }
}