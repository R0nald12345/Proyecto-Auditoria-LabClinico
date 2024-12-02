<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('horarios')->insert([
            [
                'dia' => 'Lunes',
                'horarioEntrada' => '08:00',
                'horarioSalida' => '16:00',
            ],
            [
                'dia' => 'Martes',
                'horarioEntrada' => '08:00',
                'horarioSalida' => '16:00',
            ],
            [
                'dia' => 'Miercoles',
                'horarioEntrada' => '08:00',
                'horarioSalida' => '16:00',
            ],
            [
                'dia' => 'Jueves',
                'horarioEntrada' => '08:00',
                'horarioSalida' => '16:00',
            ],
            [
                'dia' => 'Viernes',
                'horarioEntrada' => '08:00',
                'horarioSalida' => '16:00',
            ],
            [
                'dia' => 'Sabado',
                'horarioEntrada' => '09:00',
                'horarioSalida' => '13:00',
            ],
            // Agrega más registros según sea necesario
        ]);
    }
}
