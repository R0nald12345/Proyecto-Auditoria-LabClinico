<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Paciente;
use App\Models\Orden;
use App\Models\Analisis;
use App\Models\analisistotal;
use App\Models\NotaVenta;
use App\Models\ordenAnalisis;
use App\Models\Selectanalisis;
use App\Models\TipoAnalisis;

class OrdenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Crear una orden para el paciente 1 jHOEL DEBRAY
        // Crear la nota de venta
        $notaventa1 = NotaVenta::create([
            'metodoPago' => 'Paypal',
            'precio' => 150,
            'descuento' => 0,
            'precioTotal' => 150,
        ]);

        // ID ORDEN 2
        $orden = new Orden();
        $orden->idNotaVenta = $notaventa1->id;
        $orden->idPaciente = 1;     //EL PACIENTE CON ID 1 ES jHOEL DEBRAY
        $orden->save();

        // Asignar número de orden
        $orden->nroOrden = 'OR' . $orden->id;
        $orden->save();

        DB::table('orden_analisis')->insert([
            'orden_id' => $orden->id,
            'tipo_analisis_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('orden_analisis')->insert([
            'orden_id' => $orden->id,
            'tipo_analisis_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
         /*
        $ordenanalisis = new ordenAnalisis();
        $ordenanalisis->orden_id = $orden->id;
        $ordenanalisis->tipo_analisis_id = 1;
        $ordenanalisis->save();

        $ordenanalisis = new ordenAnalisis();
        $ordenanalisis->orden_id = $orden->id;
        $ordenanalisis->tipo_analisis_id = 2;
        $ordenanalisis->save();
       
        ordenAnalisis::create([
            'orden_id' => $orden->id,
            'tipo_analisis_id' => 1,
        ]);

        ordenAnalisis::create([
            'orden_id' => $orden->id,
            'tipo_analisis_id' => 2,
        ]);
        */

        // Crear un nuevo análisis para la orden ID 2
        $analisis = new Analisis();
        $analisis->estado = 'Pendiente';
        $analisis->descripcion = 'Hemograma';
        $analisis->idOrden = $orden->id;    // Orden ID 2
        $analisis->save();

        // Crear un nuevo análisis para la orden ID 2
        $analisis = new Analisis();
        $analisis->estado = 'Pendiente';
        $analisis->descripcion = 'Hormona';
        $analisis->idOrden = $orden->id;    // Orden ID 2
        $analisis->save();

        // Obtener todos los atributos correspondientes al tipo de análisis
        $atributos1 = analisistotal::where('tipo', 'Hemograma')->get();

        // Relacionar la orden con los atributos en la tabla selectanalises
        foreach ($atributos1 as $atributo1) {
            $selectedanalisis = new Selectanalisis();
            $selectedanalisis->idTipoanalisis = $atributo1->id;
            $selectedanalisis->idOrden = $orden->id;
            $selectedanalisis->save();
            /*
            Selectanalisis::create([
                'idTipoanalisis' => $atributo1->id,
                'idOrden' => $orden->id,
            ]);
            */
        }

        // Obtener todos los atributos correspondientes al tipo de análisis
        $atributos2 = analisistotal::where('tipo', 'Hormona')->get();

        // Relacionar la orden con los atributos en la tabla selectanalises
        foreach ($atributos2 as $atributo2) {
            $selectedanalisis = new Selectanalisis();
            $selectedanalisis->idTipoanalisis = $atributo2->id;
            $selectedanalisis->idOrden = $orden->id;
            $selectedanalisis->save();
            /*
            Selectanalisis::create([
                'idTipoanalisis' => $atributo2->id,
                'idOrden' => $orden->id,
            ]);
            */
        }


        // NUEVA ORDEN
        // Crear la nota de venta

        $notaventa2 = NotaVenta::create([
            'metodoPago' => 'Paypal',
            'precio' => 50,
            'descuento' => 0,
            'precioTotal' => 50,
        ]);

        // ID ORDEN 3
        $orden2 = new Orden();
        $orden2->idNotaVenta = $notaventa2->id;
        $orden2->idPaciente = 1;    // Paciente ID 1 Jhoel Debray
        $orden2->save();

        // Asignar número de orden
        $orden2->nroOrden = 'OR' . $orden2->id;
        $orden2->save();

        DB::table('orden_analisis')->insert([
            'orden_id' => $orden2->id,
            'tipo_analisis_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        /*
        $ordenanalisis = new ordenAnalisis();
        $ordenanalisis->orden_id = $orden2->id;
        $ordenanalisis->tipo_analisis_id = 1;
        $ordenanalisis->save();
        
        ordenAnalisis::create([
            'orden_id' => $orden2->id,
            'tipo_analisis_id' => 1,
        ]);
        */

        // Crear un nuevo análisis para la orden ID 3
        $analisis = new Analisis();
        $analisis->estado = 'Pendiente';
        $analisis->descripcion = 'Hemograma';
        $analisis->idOrden = $orden2->id;   // Orden ID 3
        $analisis->save();

        // Obtener todos los atributos correspondientes al tipo de análisis
        $atributos3 = analisistotal::where('tipo', 'Hemograma')->get();

        // Relacionar la orden con los atributos en la tabla selectanalises
        foreach ($atributos3 as $atributo) {
            $selectedanalisis = new Selectanalisis();
            $selectedanalisis->idTipoanalisis = $atributo->id;
            $selectedanalisis->idOrden = $orden2->id;
            $selectedanalisis->save();
            /*
            Selectanalisis::create([
                'idTipoanalisis' => $atributo->id,
                'idOrden' => $orden2->id,
            ]);
            */
        }





        // ID ORDEN 4
        // Crear la nota de venta
        $notaventa3 = NotaVenta::create([
            'metodoPago' => 'Paypal',
            'precio' => 120,
            'descuento' => 0,
            'precioTotal' => 120,
        ]);

        $orden3 = new Orden();
        $orden3->idNotaVenta = $notaventa3->id;
        $orden3->idPaciente = 4;
        $orden3->save();

        // Asignar número de orden
        $orden3->nroOrden = 'OR' . $orden3->id;
        $orden3->save();

        DB::table('orden_analisis')->insert([
            'orden_id' => $orden3->id,
            'tipo_analisis_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        /*
        $ordenanalisis = new ordenAnalisis();
        $ordenanalisis->orden_id = $orden3->id;
        $ordenanalisis->tipo_analisis_id = 2;
        $ordenanalisis->save();
        
        ordenAnalisis::create([
            'orden_id' => $orden3->id,
            'tipo_analisis_id' => 2,
        ]);
        */

        // Crear un nuevo análisis para la orden ID 4
        $analisis = new Analisis();
        $analisis->estado = 'Pendiente';
        $analisis->descripcion = 'Hormona';
        $analisis->idOrden = $orden3->id;   // Orden ID 4
        $analisis->save();

        // Obtener todos los atributos correspondientes al tipo de análisis
        $atributos4 = analisistotal::where('tipo', 'Hormona')->get();

        // Relacionar la orden con los atributos en la tabla selectanalises
        foreach ($atributos4 as $atributo4) {
            $selectedanalisis = new Selectanalisis();
            $selectedanalisis->idTipoanalisis = $atributo4->id;
            $selectedanalisis->idOrden = $orden3->id;
            $selectedanalisis->save();
            /*
            Selectanalisis::create([
                'idTipoanalisis' => $atributo4->id,
                'idOrden' => $orden3->id,
            ]);
            */
        }

    }
}
