<?php

namespace App\Models;

use App\Enums\LoanStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\Reference;

class Loan extends Model
{
    protected $casts = [
        'status' => LoanStatus::class,
    ];

    protected $guarded = ['id'];

    // Relations
    public function loanable(): MorphTo
    {
        return $this->morphTo();
    }

    public function references(): MorphMany
    {
        return $this->morphMany(Reference::class, 'referenceable');
    }

    public function transactions(): MorphMany
    {
        return $this->references()->join('transactions', 'references.transaction_id', '=', 'transactions.id')->select('transactions.*');
    }

    // Helpers
    public function isLend(): bool
    {
        return $this->direction === 'lend';
    }

    public function getSection(): Section
    {
        return $this->isLend() ? Section::typeLend()->first() : Section::typeBorrow()->first();
    }

    // Scopes
    public function scopeLend($query)
    {
        return $query->where('direction', 'lend');
    }

    public function scopeBorrow($query)
    {
        return $query->where('direction', 'borrow');
    }
}
