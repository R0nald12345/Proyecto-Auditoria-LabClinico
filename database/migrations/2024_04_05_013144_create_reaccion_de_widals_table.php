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
        Schema::create('reaccion_de_widal', function (Blueprint $table) {
            $table->id();
            $table->decimal('complementoC3', 8, 2)->nullable();
            $table->decimal('complementoC4', 8, 2)->nullable();
            $table->decimal('factorAntiNucleo', 8, 2)->nullable();
            $table->decimal('antiDNA', 8, 2)->nullable();
            $table->decimal('HAIToxo', 8, 2)->nullable();
            $table->decimal('HAIChagas', 8, 2)->nullable();
            $table->decimal('proteinaCReactiva', 8, 2)->nullable();
            $table->decimal('antiestreptolisinaO', 8, 2)->nullable();
            $table->decimal('latexRA', 8, 2)->nullable();
            $table->decimal('VDRL', 8, 2)->nullable();
            $table->decimal('antigenoO', 8, 2)->nullable();
            $table->decimal('antigenoH', 8, 2)->nullable();
            $table->decimal('antigenoA', 8, 2)->nullable();
            $table->decimal('antigenoB', 8, 2)->nullable();
            $table->decimal('reaccionDeWFelix', 8, 2)->nullable();
            $table->decimal('reaccionDeHuddleson', 8, 2)->nullable();
            $table->decimal('reaccionDePaulBunnel', 8, 2)->nullable();
            $table->decimal('helicobacterPilory', 8, 2)->nullable();
            $table->decimal('dengueAnticuerpolgG', 8, 2)->nullable();
            $table->decimal('dengueAnticuerpolgM', 8, 2)->nullable();
            $table->decimal('rubeolaAnticuerpolgG', 8, 2)->nullable();
            $table->decimal('rebeolaAnticuerpolgM', 8, 2)->nullable();
            $table->decimal('epsteinBarrViruslgG', 8, 2)->nullable();
            $table->decimal('epsteinBarrViruslgM', 8, 2)->nullable();
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
        Schema::dropIfExists('reaccion_de_widal');
    }
};
