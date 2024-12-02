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
        Schema::create('parasitologia_simple', function (Blueprint $table) {
            $table->id();
            $table->string('color')->nullable();
            $table->string('consistencia')->nullable();
            $table->string('parasitos')->nullable();
            $table->decimal('precio', 10, 2);
            $table->string('estado')->default('pendiente');
            $table->unsignedBigInteger('idAnalisis');
            $table->foreign('idAnalisis')->references('id')->on('analisis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parasitologia_simple');
    }
};
