<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'passport_number' => $this->passport_number,
            'last_name' => $this->last_name,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'position' => $this->position,
            'phone' => $this->phone,
            'address' => $this->address,
            'enterprise_id' => $this->enterprise_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
