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
        Schema::create('requeests', function (Blueprint $table) {
            $table->id(); 
            $table->enum('statue', ['PENDING', 'ACCEPTED'])->default('PENDING');
            $table->foreignId('user_id')->nullable()->constrained()->references('id')->on('users');
            $table->foreignId('supplier_id')->nullable()->constrained()->references('id')->on('users')->default(null);
            $table->foreignId('client_id')->nullable()->constrained()->references('id')->on('users')->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    
    public function down(): void
    {
        Schema::dropIfExists('requeests');
    }
};
