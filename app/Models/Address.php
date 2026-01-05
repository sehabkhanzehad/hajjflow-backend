<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'type' => 'string',
    ];

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get formatted full address
     */
    public function getFormattedAddressAttribute(): string
    {
        $parts = array_filter([
            $this->house_no,
            $this->road_no,
            $this->village,
            $this->post_office ? 'P.O: ' . $this->post_office : null,
            $this->police_station ? 'P.S: ' . $this->police_station : null,
            $this->district,
            $this->division,
            $this->postal_code,
            $this->country,
        ]);

        return implode(', ', $parts);
    }
}
