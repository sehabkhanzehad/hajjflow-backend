<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'type' => 'transaction',
            'attributes' => [
                'type' => $this->type,
                'voucher_no' => $this->voucher_no,
                'title' => $this->title,
                'description' => $this->description,
                'amount' => $this->amount,
                'before_balance' => $this->before_balance,
                'after_balance' => $this->after_balance,
                'date' => $this->date,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'section' => new SectionResource($this->whenLoaded('section')),
                'references' => ReferenceResource::collection($this->whenLoaded('references')),
            ],
        ];
    }
}
