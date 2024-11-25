<?php

namespace Modules\Hr\App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        return [
            'id'                => (string) $this->id,
            'first_name'        => (string) $this->first_name,
            'last_name'         => (string) $this->last_name,
            'email'             => (string) $this->email,
        ];
    }
}