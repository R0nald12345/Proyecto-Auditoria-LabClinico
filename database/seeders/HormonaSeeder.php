<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HormonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hormonas')->insert([
            'id' => 1, // El ID que quieres insertar
            'TSH' => 2.50,
            'T3' => 1.20,
            'T4' => 0.90,
            'TSHNeonatal' => 1.10,
            'T4Libre' => 1.00,
            'progesterona' => 5.60,
            'prolactina' => 10.00,
            'estradiol' => 2.50,
            'cortisol8am' => 18.00,
            'cortisol16pm' => 8.00,
            'LH' => 5.00,
            'FSH' => 3.50,
            'testosterona' => 6.50,
            'testosteronaTotal' => 7.20,
            'testosteronaLibre' => 1.80,
            'HDeCrecimiento' => 15.00,
            'HDeCrecimientoPostEjercicio' => 18.00,
            'insulina' => 25.00,
            'AcAntiTP0' => 30.00,
            'DHEA' => 1.20,
            'DHEAS' => 2.50,
            'TPH' => 3.00,
            'OHPPRG' => 0.90,
            'antiCCP' => 2.30,
            'gastrina' => 15.00,
            'aldosterona' => 8.00,
            'HParatiroidea' => 9.50,
            'antAntitiroglobulinaTG' => 1.70,
            'acVanilMandelico' => 1.80,
            'IGFISomatomedina' => 2.60,
            'IGFBP3' => 2.70,
            'insulinaPostPand' => 3.40,
            'estado' => 'pendiente', // Valor predeterminado
            'idAnalisis' => 1, // Asegúrate de que este ID exista en la tabla analisis
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
