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
        Schema::create('product_request', function (Blueprint $table) {
            $table->id();
            $table->foreignId('productid')->nullable()->constrained()->references('id')->on('products');
            $table->foreignId('request_id')->constrained()->references('id')->on('requeests')->onDelete("cascade");
            $table->string('productdescription');
            $table->boolean('is_Delivered')->default(false);

            $table->integer('quantity');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_request');
    }
};
