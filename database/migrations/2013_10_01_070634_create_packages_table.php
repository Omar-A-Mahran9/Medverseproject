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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_name');
            $table->string('type')->nullable();
            $table->integer('price');
            $table->boolean('Cloud inventory system');
            $table->boolean('One clinic  (you can add more)');
            $table->boolean('Reports');
            $table->boolean('E-store');
            $table->boolean('Analysis');
            $table->boolean('Online Consultation (one session)');
            $table->boolean('One to one Consultation (one session)');
            $table->boolean('4 clinics (you can add more)');
            $table->boolean('Edit account');





            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
