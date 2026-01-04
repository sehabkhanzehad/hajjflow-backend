<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('model_passport', function (Blueprint $table) {
            $table->id();
            $table->foreignId('passport_id')->constrained()->cascadeOnDelete();
            $table->string('passportable_id');
            $table->string('passportable_type');
            $table->timestamps();

            // Ensure unique passport per model
            $table->unique(['passport_id', 'passportable_id', 'passportable_type'], 'unique_passport_per_model');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_passport');
    }
};
