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
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_analisis');
            $table->date('fecha');
            $table->string('doctor');
            $table->string('precion_arterial');
            $table->string('peso');
            $table->string('altura');
            $table->text('notas')->nullable();
            $table->unsignedBigInteger('idBioquimico');
            $table->unsignedBigInteger('idHistorial');
            $table->foreign('idBioquimico')->references('id')->on('bioquimicos')->onDelete('cascade');
            $table->foreign('idHistorial')->references('id')->on('historiales')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros');
    }
};
