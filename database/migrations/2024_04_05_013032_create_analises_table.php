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
        Schema::create('analisis', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion')->nullable();
            $table->foreignId('idOrden')->constrained('ordenes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('estado')->nullable();
            $table->foreignId('idBioquimico')->nullable()->constrained('bioquimicos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analisis');
    }
};
