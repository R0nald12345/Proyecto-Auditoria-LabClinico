<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Paciente;
use App\Models\Orden;
use App\Models\Analisis;
use App\Models\Historial;
use App\Models\User;

use App\Models\TipoAnalisis;

class AnalisisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ID 7
        $user6 = User::create([
            'name' => 'Paciente',
            'email' => 'paciente@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Paciente');

        $historial5 = Historial::create([
            'nroHistoria' => 'H-5',
            'fechaRegistro' => '2024-06-10',
            'antecedentesPatologicos' => 'ninguno',
        ]);

        // Crear un paciente
        // PACIENTE ID 5
        $paciente = new Paciente();
        $paciente->ci = '1234567';
        $paciente->nombre = 'Paciente Lucas';
        $paciente->sexo = 'MASCULINO';
        $paciente->correo = 'paciente@gmail.com';
        $paciente->telefono = '77889911';
        $paciente->fechaNacimiento = '2006-01-01';
        $paciente->idTipoSeguro = 1; // Asigna el ID del tipo de seguro correspondiente
        $paciente->idHistorial = $historial5->id;
        $paciente->idUser = $user6->id;     // idUser 7
        $paciente->save();

        // Crear una orden para el paciente
        //ID ORDEN 1
        $orden = new Orden();
        $orden->idPaciente = $paciente->id;     // PACIENTE ID 5
        $orden->save();

        // Asignar número de orden
        $orden->nroOrden = 'OR' . $orden->id;
        $orden->save();

        // Tipos de análisis a incluir en la orden (suponiendo que tienes un array de IDs de tipos de análisis)
        $tipoAnalisisIds = [1, 4]; // Ejemplo de IDs de tipos de análisis

        // Iterar sobre los tipos de análisis y crear análisis para la orden
        foreach ($tipoAnalisisIds as $tipoAnalisisId) {
            // Insertar en la tabla intermedia
            DB::table('orden_analisis')->insert([
                'orden_id' => $orden->id,
                'tipo_analisis_id' => $tipoAnalisisId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Obtener el nombre del tipo de análisis utilizando el ID
            $tipoAnalisis = TipoAnalisis::find($tipoAnalisisId);

            // Crear un nuevo análisis para la orden
            $analisis = new Analisis();
            $analisis->estado = 'Pendiente';
            $analisis->descripcion = $tipoAnalisis->nombre; // Acceder al nombre del tipo de análisis
            $analisis->idOrden = $orden->id;
            $analisis->save();

        }

        $this->command->info('¡Datos de análisis generados exitosamente!');
    }
}
