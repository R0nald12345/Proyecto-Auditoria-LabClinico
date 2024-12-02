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
        Schema::create('selectanalises', function (Blueprint $table) {
            $table->id();
            $table->unique(['idTipoanalisis', 'idOrden']);
            $table->foreignId('idTipoanalisis')->nullable()->constrained('analisistotals');
            $table->foreignId('idOrden')->nullable()->constrained('ordenes');
            $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analisistotals');
    }
};
