<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReferenceResource extends JsonResource
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
            'type' => 'reference',
            'attributes' => [
                'referenceable_type' => $this->referenceable_type,
                'referenceable_id' => $this->referenceable_id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'referenceable' => $this->whenLoaded('referenceable', function () {
                    $resourceClass = class_basename($this->referenceable_type) . 'Resource';
                    $fullClassName = "App\\Http\\Resources\\Api\\{$resourceClass}";
                    if (class_exists($fullClassName)) {
                        return new $fullClassName($this->referenceable);
                    }
                    return $this->referenceable;
                }),
            ],
        ];
    }
}
