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
        Schema::table('group_leaders', function (Blueprint $table) {
            // Make agency_id NOT NULL
            $table->uuid('agency_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('group_leaders', function (Blueprint $table) {
            // Make agency_id nullable again
            $table->uuid('agency_id')->nullable()->change();
        });
    }
};
