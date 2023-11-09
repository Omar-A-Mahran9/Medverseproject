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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('productcode')->unique();
            $table->string('productname');
            $table->string('group');
            $table->integer('Qty');
            $table->integer('price');
            $table->timestamps();
            $table->foreignId('group_id')->nullable()->constrained()->references('id')->onDelete('cascade')->on('products');

            $table->foreignId('user_id')->nullable()->constrained()->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
