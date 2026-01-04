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
        Schema::table('users', function (Blueprint $table) {
            $table->string('full_name')->nullable()->after('last_name');
            $table->string('first_name_bangla')->nullable()->after('full_name');
            $table->string('last_name_bangla')->nullable()->after('first_name_bangla');
            $table->string('full_name_bangla')->nullable()->after('last_name_bangla');
            $table->string('mother_name_bangla')->nullable()->after('mother_name');
            $table->string('father_name_bangla')->nullable()->after('father_name');
            $table->string('birth_certificate_number')->nullable()->after('nid');

            $table->index('full_name');
            $table->index('full_name_bangla');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'full_name',
                'first_name_bangla',
                'last_name_bangla',
                'full_name_bangla',
                'mother_name_bangla',
                'father_name_bangla',
            ]);
        });
    }
};
