<?php

namespace App\Models\Traits;

use App\Models\Passport;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasPassport
{
    // Relations
    public function passport(): MorphOne
    {
        return $this->morphOne(Passport::class, 'passportable', 'model_passport')->withTimestamps();
    }

    /* Helpers */
    public function hasPassport(): bool
    {
        return $this->passport()->exists();
    }

    public function assignPassport(Passport $passport): void
    {
        $this->passport()->save($passport);
    }

    public function removePassport(): void
    {
        $this->passport()->delete();
    }
}
