<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReplaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "type" => "replace",
            "id" => $this->id,
            "attributes" => [
                "replaceDate" => $this->date,
                "note" => $this->note,
                "createdAt" => $this->created_at,
                "updatedAt" => $this->updated_at,
            ],
            "relationships" => [
                "oldPreRegistration" => new PreRegistrationResource($this->whenLoaded("oldPreRegistration")),
                "newPreRegistration" => new PreRegistrationResource($this->whenLoaded("newPreRegistration")),
            ],
        ];
    }
}
