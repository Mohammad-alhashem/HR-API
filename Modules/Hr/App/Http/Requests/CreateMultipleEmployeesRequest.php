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
        return [
            'employees'                     => 'required|array',
            'employees.*.first_name'        => 'required|string|max:45|min:3',
            'employees.*.last_name'         => 'required|string|max:45|min:3',
            'employees.*.email'             => 'required|email|unique:employees,email',
        ];
    }

    public function after(): array
    {
        // check if duplicate email in same request
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
        return [
            // 'name.required'     => 'Name is required',
        ];
    }
}