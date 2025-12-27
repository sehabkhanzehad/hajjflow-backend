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
                'voucherNo' => $this->voucher_no,
                'title' => $this->title,
                'description' => $this->description,
                'amount' => $this->amount,
                'beforeBalance' => $this->before_balance,
                'afterBalance' => $this->after_balance,
                'date' => $this->date,
                'createdAt' => $this->created_at,
            ],
            'relationships' => [
                'section' => new SectionResource($this->whenLoaded('section')),
                'references' => ReferenceResource::collection($this->whenLoaded('references')),
            ],
        ];
    }
}
