<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PassportResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'type' => 'passport',
            'id' => $this->id,
            'attributes' => [
                'passportNumber' => $this->passport_number,
                'issueDate' => $this->issue_date,
                'expiryDate' => $this->expiry_date,
                'passportType' => $this->passport_type,
                'filePath' => $this->file_path,
                'notes' => $this->notes,
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at,
            ],
        ];
    }
}
