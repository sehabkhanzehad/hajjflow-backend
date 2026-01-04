<?php

namespace App\Models\Traits;

use App\Models\Passport;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasPassport
{
    // Relations
    public function passports(): MorphToMany
    {
        return $this->morphToMany(Passport::class, 'passportable', 'model_passport')
            ->withTimestamps();
    }

    public function passport(): ?Passport
    {
        return $this->passports()->first();
    }

    /* Helpers */
    public function hasPassport(): bool
    {
        return $this->passports()->exists();
    }

    public function assignPassport(Passport $passport): void
    {
        $this->passports()->sync([$passport->id]);
    }

    public function removePassport(): void
    {
        $this->passports()->detach();
    }
}
