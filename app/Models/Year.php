<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => 'boolean',
    ];

    protected $guarded = ['id'];

    // Helpers
    public function isActive(): bool
    {
        return $this->status;
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
