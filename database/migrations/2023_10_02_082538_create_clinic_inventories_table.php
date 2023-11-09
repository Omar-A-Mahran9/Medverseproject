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
        Schema::create('clinic_inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinic_id')->nullable()->constrained()->references('id')->on('clinics')->onDelete("cascade");
            $table->foreignId('userinventory_id')->nullable()->constrained()->references('id')->on('user_inventories')->onDelete("cascade");
            $table->foreignId('product_id')->nullable()->constrained()->references('id')->on('products')->onDelete("cascade");
            $table->integer("Quantity");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinic_inventories');
    }
};
