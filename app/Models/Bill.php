<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bill extends Model
{
    protected $fillable = [
        'section_id',
        'number',
        'biller_name',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
}
