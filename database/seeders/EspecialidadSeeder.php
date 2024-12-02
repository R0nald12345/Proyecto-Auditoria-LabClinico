<?php

namespace Database\Seeders;


use App\Models\Especialidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Especialidad::create([

            'nombre' => 'Hematología',
            'descripcion' => 'Es el estudio de la sangre y las enfermedades relacionadas con ella.'
        ]);

        Especialidad::create([
            'nombre' => 'Endocrinología',
            'descripcion' => 'Se encargan del análisis de hormonas en el cuerpo, incluyendo hormonas tiroideas, hormonas sexuales, hormonas del estrés y otras.'
        ]);

        Especialidad::create([
            'nombre' => 'Bioquímica Clínica',
            'descripcion' => 'Se centran en la medición de diferentes componentes químicos en la sangre, como glucosa, lípidos, enzimas, electrolitos y metabolitos, para evaluar la función de varios órganos y sistemas del cuerpo.'
        ]);

        Especialidad::create([
            'nombre' => 'Parasitología',
            'descripcion' => 'Capacitados para identificar parásitos en muestras biológicas, como heces, orina o sangre.'
        ]);

        Especialidad::create([
            'nombre' => 'Nefrología',
            'descripcion' => 'Se encarga del análisis de muestras de orina para evaluar la función renal y detectar posibles trastornos del sistema urinario.'
        ]);

        Especialidad::create([
            'nombre' => 'Microbiología Clínica',
            'descripcion' => 'Se enfoca en el diagnóstico de infecciones causadas por microorganismos. La prueba de la reacción de Widal es una técnica específica utilizada para diagnosticar la fiebre tifoidea y otras enfermedades bacterianas transmitidas por alimentos y agua.'

        ]);
    }
}
