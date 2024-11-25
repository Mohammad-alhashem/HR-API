<?php

namespace Modules\Hr\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class CreateMultipleEmployeesRequest extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // validation rules for creating multiple employees
        return [
            'employees'                     => 'required|array',
            'employees.*.first_name'        => 'required|string|max:45|min:2',
            'employees.*.last_name'         => 'required|string|max:45|min:2',
            'employees.*.email'             => 'required|email|unique:employees,email|max:190|min:5',
        ];
    }

    public function after(): array
    {
        // check if duplicate email in same request
        // when any email is duplicate in same request, it will return error with duplicated emails
        return [
            function (Validator $validator) {
                collect($this->employees)->pluck('email')->each(function ($email, $index) use($validator){
                    if(collect($this->employees)->where('email', $email)->count() > 1){
                        $validator->errors()->add(
                            'employees.'.$index.'.email',
                            'Duplicate email in same request - ' . $email
                        );
                    }
                });
            }
        ];
    }

    public function messages()
    {
        // i used default validation messages.
        return [
            
        ];
    }
}