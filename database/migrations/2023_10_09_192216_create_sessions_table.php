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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->references('id')->on('users')->onDelete("cascade");
            $table->string('sessionname');
            $table->integer('sessionprice');
            $table->string('sessionimage');
            $table->string('sessionlink');
            $table->enum('sessiontype', ['Online', 'Offline','others'])->default('Online');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
