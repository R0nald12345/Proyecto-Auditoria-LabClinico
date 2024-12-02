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
        Schema::create('orina_completa', function (Blueprint $table) {
            $table->id();
            $table->integer('volumen')->nullable();
            $table->string('color')->nullable();
            $table->string('aspecto')->nullable();
            $table->float('densidad')->nullable();
            $table->float('ph')->nullable();
            $table->string('olor')->nullable();
            $table->string('proteinas')->nullable();
            $table->string('glucosa')->nullable();
            $table->string('cetonas')->nullable();
            $table->string('urobilinogeno')->nullable();
            $table->string('hemoglobina')->nullable();
            $table->string('nitritos')->nullable();
            $table->string('bilirrubina')->nullable();
            $table->string('sangre')->nullable();
            $table->integer('celulasEpiteliales')->nullable();
            $table->integer('eritrocitos')->nullable();
            $table->integer('leucocitos')->nullable();
            $table->string('bacterias')->nullable();
            $table->string('filamentosDeMucus')->nullable();
            $table->string('cristalesUratosAmorfes')->nullable();
            $table->string('cristalesOxalatoDeCalcio')->nullable();
            $table->string('cristalesFosfatosAmorfos')->nullable();
            $table->string('cristalesDeAcidoUrico')->nullable();
            $table->string('cilindrosHialino')->nullable();
            $table->string('cilindrosGranuloso')->nullable();
            $table->string('cilindrosLeucocitario')->nullable();
            $table->string('levaduras')->nullable();
            $table->string('fosfTripleDeAmonioYMagnesio')->nullable();
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
        Schema::dropIfExists('orina_completa');
    }
};
