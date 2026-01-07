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
        Schema::table('user', function (Blueprint $table) {
            $table->string('occupation')->nullable()->after('password');
            $table->string('spouse_name')->nullable()->after('father_name_bangla');
            $table->dropColumn('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn('occupation');
            $table->dropColumn('spouse_name');
            $table->string('address')->nullable()->after('date_of_birth');
        });
    }
};
