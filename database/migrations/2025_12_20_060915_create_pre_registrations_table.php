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
        Schema::create('pre_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_leader_id')->constrained()->restrictOnDelete();
            $table->foreignId('pilgrim_id')->constrained()->restrictOnDelete();
            $table->foreignId('bank_id')->constrained()->restrictOnDelete();

            $table->string('serial_no')->nullable();
            $table->string('bank_voucher_no')->nullable();

            $table->date('date')->nullable();
            $table->string('status');
            $table->date('archive_date')->nullable();

            $table->timestamps();

            $table->index(['status', 'date', 'serial_no']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_registrations');
    }
};
