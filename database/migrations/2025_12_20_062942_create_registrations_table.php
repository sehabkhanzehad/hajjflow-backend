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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('year_id')->constrained()->restrictOnDelete();
            $table->foreignId('pre_registration_id')->unique()->constrained()->restrictOnDelete();
            $table->foreignId('pilgrim_id')->constrained()->restrictOnDelete();
            $table->foreignId('package_id')->constrained()->restrictOnDelete();
            $table->foreignId('bank_id')->constrained()->restrictOnDelete();

            $table->date('date');
            $table->string('passport_number');
            $table->date('passport_expiry_date');

            $table->string('status')->default('active');

            $table->timestamps();

            $table->index([
                "status",
                "passport_number",
                "passport_expiry_date",
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
