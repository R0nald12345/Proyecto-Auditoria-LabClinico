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
        Schema::create('hormonas', function (Blueprint $table) {
            $table->id();
            $table->decimal('TSH', 8, 2)->nullable();
            $table->decimal('T3', 8, 2)->nullable();
            $table->decimal('T4', 8, 2)->nullable();
            $table->decimal('TSHNeonatal', 8, 2)->nullable();
            $table->decimal('T4Libre', 8, 2)->nullable();
            $table->decimal('progesterona', 8, 2)->nullable();
            $table->decimal('prolactina', 8, 2)->nullable();
            $table->decimal('estradiol', 8, 2)->nullable();
            $table->decimal('cortisol8am', 8, 2)->nullable();
            $table->decimal('cortisol16pm', 8, 2)->nullable();
            $table->decimal('LH', 8, 2)->nullable();
            $table->decimal('FSH', 8, 2)->nullable();
            $table->decimal('testosterona', 8, 2)->nullable();
            $table->decimal('testosteronaTotal', 8, 2)->nullable();
            $table->decimal('testosteronaLibre', 8, 2)->nullable();
            $table->decimal('HDeCrecimiento', 8, 2)->nullable();
            $table->decimal('HDeCrecimientoPostEjercicio', 8, 2)->nullable();
            $table->decimal('insulina', 8, 2)->nullable();
            $table->decimal('AcAntiTP0', 8, 2)->nullable();
            $table->decimal('DHEA', 8, 2)->nullable();
            $table->decimal('DHEAS', 8, 2)->nullable();
            $table->decimal('TPH', 8, 2)->nullable();
            $table->decimal('OHPPRG', 8, 2)->nullable();
            $table->decimal('antiCCP', 8, 2)->nullable();
            $table->decimal('gastrina', 8, 2)->nullable();
            $table->decimal('aldosterona', 8, 2)->nullable();
            $table->decimal('HParatiroidea', 8, 2)->nullable();
            $table->decimal('antAntitiroglobulinaTG', 8, 2)->nullable();
            $table->decimal('acVanilMandelico', 8, 2)->nullable();
            $table->decimal('IGFISomatomedina', 8, 2)->nullable();
            $table->decimal('IGFBP3', 8, 2)->nullable();
            $table->decimal('insulinaPostPand', 8, 2)->nullable();
            $table->string('resultado')->nullable();
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
        Schema::dropIfExists('hormonas');
    }
};
