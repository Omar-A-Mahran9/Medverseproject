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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->nullable();
             $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('clinicname')->nullable();
            $table->string('universityname')->nullable();
            $table->string('companyname')->nullable();
            $table->string('position')->nullable();
            $table->string('Address')->nullable();
            $table->enum('type', ['DOCTOR','USER', 'STUDENT','Others'])->default('USER');
            $table->string('image')->nullable();
            $table->enum('role', ['USER', 'ADMIN', 'SUPPLIER','CLIENT','DOCTOR','STUDENT'])->default('CLIENT');
            $table->string('Location')->nullable();
             $table->string('email')->unique();
             $table->foreignId('Package_id')->nullable()->constrained()->references('id')->on('packages')->onDelete("cascade");
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
