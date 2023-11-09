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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->references('id')->on('users')->onDelete("cascade");
            $table->foreignId('product_id')->constrained()->references('id')->on('products')->onDelete("cascade");
            $table->foreignId('clinic_id')->nullable()->constrained()->references('id')->on('clinics')->onDelete("cascade");
            $table->integer('mainQty');
            $table->integer('subQty');
            $table->integer('requestQty');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
