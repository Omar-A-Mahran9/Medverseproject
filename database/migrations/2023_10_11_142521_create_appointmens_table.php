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
        Schema::create('appointmens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->references('id')->on('users')->onDelete("cascade");
            $table->foreignId('session_id')->nullable()->constrained()->references('id')->on('sessions')->onDelete("cascade");
            $table->foreignId('sessioncalender_id')->nullable()->constrained()->references('id')->on('sessioncalenders')->onDelete("cascade");
            $table->foreignId('sessiontime_id')->nullable()->constrained()->references('id')->on('sessiontimes')->onDelete("cascade");
            $table->enum('statue', ['PAID', 'UNPAID'])->default('UNPAID');
            $table->integer('price');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointmens');
    }
};
