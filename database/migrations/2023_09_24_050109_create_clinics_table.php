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
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('clinicname');
            $table->string('clinicpric');
            $table->enum('statue', ['PENDING', 'ACCEPTED','REJECTED'])->default('PENDING');
            $table->foreignId('order_id')->nullable()->constrained()->references('id')->on('orders')->onDelete("cascade");
            $table->foreignId('mainclinic_id')->nullable()->constrained()->references('id')->on('mainclinics')->onDelete("cascade");;

            $table->foreignId('user_id')->nullable()->constrained()->references('id')->on('users')->onDelete("cascade");;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinics');
    }
};
