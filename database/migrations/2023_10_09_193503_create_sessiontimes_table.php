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
        Schema::create('sessiontimes', function (Blueprint $table) {
            $table->id();
            $table->string('sessiontime');
            $table->foreignId('user_id')->nullable()->constrained()->references('id')->on('users')->onDelete("cascade");
            $table->foreignId('sessioncalender_id')->nullable()->constrained()->references('id')->on('sessioncalenders')->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessiontimes');
    }
};
