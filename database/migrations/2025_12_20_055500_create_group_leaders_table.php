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
        Schema::create('group_leaders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->restrictOnDelete();
            $table->foreignId('section_id')->unique()->constrained()->restrictOnDelete();
            $table->string('group_name');
            $table->boolean('status')->default(true);
            $table->boolean('pilgrim_required')->default(false); // true = required, false = nullable
            $table->timestamps();

            $table->index(['group_name', 'status', 'pilgrim_required']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_leaders');
    }
};
