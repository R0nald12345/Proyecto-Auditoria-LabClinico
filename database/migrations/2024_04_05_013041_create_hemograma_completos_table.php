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
        Schema::create('hemograma_completos', function (Blueprint $table) {
            $table->id();
            $table->integer('globulosRojos')->nullable();
            $table->float('hematocrito')->nullable();
            $table->float('hemoglobina')->nullable();
            $table->float('VCM')->nullable();
            $table->float('HCM')->nullable();
            $table->float('CHCM')->nullable();
            $table->integer('VSG')->nullable();
            $table->integer('plaquetas')->nullable();
            $table->integer('recuento')->nullable();
            $table->integer('globulosBlancos')->nullable();
            $table->integer('promielocitos')->nullable();
            $table->integer('mielocitos')->nullable();
            $table->integer('metamielocitos')->nullable();
            $table->integer('cayados')->nullable();
            $table->integer('segmentados')->nullable();
            $table->integer('linfocitos')->nullable();
            $table->integer('monocitos')->nullable();
            $table->integer('eosinofilos')->nullable();
            $table->integer('basofilos')->nullable();
            $table->integer('blastos')->nullable();
            $table->string('grupoSanguineo')->nullable();
            $table->string('factorRh')->nullable();
            $table->string('VDRL')->nullable();
            $table->string('baciloscopia')->nullable();
            $table->string('coproparasitologico')->nullable();
            $table->string('estado')->default('pendiente');
            $table->string('metodo')->nullable();
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
        Schema::dropIfExists('hemograma_completos');
    }
};
