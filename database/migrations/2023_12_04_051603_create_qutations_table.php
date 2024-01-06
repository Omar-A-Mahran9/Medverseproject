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
        Schema::create('qutations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requests_id')->unique()->constrained()->references('id')->on('requeests')->onDelete("cascade");
            $table->foreignId('user_id')->nullable()->constrained()->references('id')->on('users')->onDelete("cascade");
            $table->integer('Taxes')->nullable();
            $table->integer('Delivery')->nullable();
            $table->string('refuse_comment')->nullable(); 
            $table->enum('statue', ['PENDING', 'ACCEPTED','REJECTED'])->default('PENDING');

            $table->boolean('Paid')->nullable()->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qutations');
    }
};
