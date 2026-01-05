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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('addressable_type');
            $table->string('addressable_id');
            $table->enum('type', ['present', 'permanent'])->default('present');

            // Address fields
            $table->string('house_no')->nullable();
            $table->string('road_no')->nullable();
            $table->string('village')->nullable();
            $table->string('post_office')->nullable(); // P.O
            $table->string('police_station')->nullable(); // P/S or Thana
            $table->string('district')->nullable();
            $table->string('division')->nullable(); // State/Division
            $table->string('postal_code')->nullable();
            $table->string('country')->default('Bangladesh');
            $table->timestamps();

            // Index for faster queries
            $table->index(['addressable_type', 'addressable_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
