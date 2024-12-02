<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\HemogramaCompleto;
use App\Models\Analisis;

class HemogramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear datos de ejemplo para HemogramaCompleto
        $hemograma = new HemogramaCompleto();
        $hemograma->globulosRojos = 5;
        $hemograma->hematocrito = 45.7;
        $hemograma->hemoglobina = 15.2;
        $hemograma->VCM = 89.5;
        $hemograma->HCM = 31.8;
        $hemograma->CHCM = 35.4;
        $hemograma->VSG = 15;
        $hemograma->plaquetas = 300000;
        $hemograma->globulosBlancos = 6500;
        $hemograma->promielocitos = 1;
        $hemograma->mielocitos = 1;
        $hemograma->metamielocitos = 0;
        $hemograma->cayados = 0;
        $hemograma->segmentados = 65;
        $hemograma->linfocitos = 25;
        $hemograma->monocitos = 8;
        $hemograma->eosinofilos = 2;
        $hemograma->basofilos = 0;
        $hemograma->grupoSanguineo = 'A';
        $hemograma->factorRh = '+';
        $hemograma->VDRL = 'NO REACTOR';
        $hemograma->baciloscopia = 'MUESTRA NO ADECUADA';
        $hemograma->coproparasitologico = 'NO SE OBSERVAN PARASITOS';
        $hemograma->metodo = 'ELISA';
        $hemograma->resultado = 'NO REACTIVO';
        $hemograma->idAnalisis = 1; // Asigna el ID del análisis correspondiente
        $hemograma->save();


        // Actualizar el estado del análisis a "Realizado"
        $analisis = Analisis::find(1); // Suponiendo que el ID del análisis es 1
        $analisis->idBioquimico = 1; // Asigna el ID del bioquímico correspondiente
        $analisis->estado = 'Realizado';
        $analisis->save();

        $this->command->info('¡Datos de HemogramaCompleto generados exitosamente!');
    }
}

