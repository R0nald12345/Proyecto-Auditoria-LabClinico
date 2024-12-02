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
        Schema::create('quimica_sanguinea', function (Blueprint $table) {
            $table->id();
            $table->decimal('glucosa', 10, 2)->nullable();
            $table->decimal('urea', 10, 2)->nullable();
            $table->decimal('creatinina', 10, 2)->nullable();
            $table->decimal('acidoUrico', 10, 2)->nullable();
            $table->decimal('colesterol', 10, 2)->nullable();
            $table->decimal('trigliceridos', 10, 2)->nullable();
            $table->decimal('colesterolHDL', 10, 2)->nullable();
            $table->decimal('colesterolLDL', 10, 2)->nullable();
            $table->decimal('colesterolVLDL', 10, 2)->nullable();
            $table->decimal('lipidoTotales', 10, 2)->nullable();
            $table->decimal('fosfolipidos', 10, 2)->nullable();
            $table->decimal('proteinasTotales', 10, 2)->nullable();
            $table->decimal('albuminas', 10, 2)->nullable();
            $table->decimal('globulina', 10, 2)->nullable();
            $table->decimal('cloro', 10, 2)->nullable();
            $table->decimal('sodio', 10, 2)->nullable();
            $table->decimal('potasio', 10, 2)->nullable();
            $table->decimal('calcio', 10, 2)->nullable();
            $table->decimal('calcioIonico', 10, 2)->nullable();
            $table->decimal('troponina', 10, 2)->nullable();
            $table->decimal('ferritina', 10, 2)->nullable();
            $table->decimal('transferrina', 10, 2)->nullable();
            $table->decimal('fosforo', 10, 2)->nullable();
            $table->decimal('hierro', 10, 2)->nullable();
            $table->decimal('litio', 10, 2)->nullable();
            $table->decimal('magnesio', 10, 2)->nullable();
            $table->decimal('amilasa', 10, 2)->nullable();
            $table->decimal('lipasa', 10, 2)->nullable();
            $table->decimal('transaminasaGOT', 10, 2)->nullable();
            $table->decimal('transaminasaGPT', 10, 2)->nullable();
            $table->decimal('fosfatasaAlcalina', 10, 2)->nullable();
            $table->decimal('fosfAcidaTotal', 10, 2)->nullable();
            $table->decimal('fostAcidaProstatica', 10, 2)->nullable();
            $table->decimal('creatinFosfoKinasaCPK', 10, 2)->nullable();
            $table->decimal('deshidrogemasaLacticaLDH', 10, 2)->nullable();
            $table->string('estado')->default('pendiente');
            $table->string('resultado')->nullable();
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
        Schema::dropIfExists('quimica_sanguinea');
    }
};
