<?php

namespace Modules\Hr\App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

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
            'name'              => (string) $this->name,
            'email'             => (string) $this->email,
            'image'             => (string) $this->image,
        ];

    }

    
}
