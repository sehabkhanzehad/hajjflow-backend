<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'section',
            'id' => $this->id,
            'attributes' => [
                'code' => $this->code,
                'name' => $this->name,
                'type' => $this->type,
                'description' => $this->description,
            ],
            'relationships' => [
                "bank" => new BankResource($this->whenLoaded('bank')),
                "groupLeader" => new GroupLeaderResource($this->whenLoaded('groupLeader')),
                "employee" => new EmployeeResource($this->whenLoaded('employee')),
                "bill" => new BillResource($this->whenLoaded('bill')),
            ],
        ];
    }
}
