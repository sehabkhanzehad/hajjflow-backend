<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Replace extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'replace_date' => 'date',
    ];

    // Relationships
    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    public function oldPreRegistration(): BelongsTo
    {
        return $this->belongsTo(PreRegistration::class, 'old_pre_registration_id');
    }

    public function newPreRegistration(): BelongsTo
    {
        return $this->belongsTo(PreRegistration::class, 'new_pre_registration_id');
    }
}
