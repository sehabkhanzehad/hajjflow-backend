<?php

namespace App\Models;

use App\Enums\UmrahStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Umrah extends Model
{
    protected $casts = [
        'status' => UmrahStatus::class,
    ];

    protected $guarded = ['id'];

    public function year(): BelongsTo
    {
        return $this->belongsTo(Year::class);
    }

    public function groupLeader(): BelongsTo
    {
        return $this->belongsTo(GroupLeader::class);
    }

    public function pilgrim(): BelongsTo
    {
        return $this->belongsTo(Pilgrim::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    protected static function booted()
    {
        static::creating(function (Umrah $model) {
            $model->year_id = Year::getCurrentYear()?->id;
        });
    }
}
