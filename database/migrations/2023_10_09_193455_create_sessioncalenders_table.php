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
        Schema::create('sessioncalenders', function (Blueprint $table) {
            $table->id();
            $table->date('sessioncalender');
            $table->foreignId('user_id')->nullable()->constrained()->references('id')->on('users')->onDelete("cascade");
            $table->foreignId('session_id')->nullable()->constrained()->references('id')->on('sessions')->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessioncalenders');
    }
};
