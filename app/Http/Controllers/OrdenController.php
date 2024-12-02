<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Orden;
use App\Models\TipoAnalisis;
use App\Models\OrdenAnalisis;
use Illuminate\Support\Facades\DB;
use App\Models\Analisis;
use App\Models\Bioquimico;
use App\Models\Paciente;
use App\Models\TipoSeguro;
use App\Models\User;
use App\Models\Hormonas;
use App\Models\HemogramaCompleto;
use App\Models\Selectanalisis;
use App\Models\analisistotal;
use Illuminate\Http\Request;


class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $paciente = Paciente::where('idUser', $user->id)->first();
        $heads = [
            'Id',
            'Nro Orden',
            'Tipo Analisis',
            'Fecha',
            'Paciente',
            'Estado',

            ['label' => 'Acciones', 'no-export' => true],
        ];

        if($paciente){
$orden=Orden::where('idPaciente',$paciente->id)->get();
$ordenesConAnalisis = Orden::with('ordenAnalisis')->get();
$datosOrdenAnalisis = OrdenAnalisis::with('tipoAnalisis')->get();
        }else{
            $orden = Orden::all();
            $ordenesConAnalisis = Orden::with('ordenAnalisis')->get();
            $datosOrdenAnalisis = OrdenAnalisis::with('tipoAnalisis')->get();
        }
        // dd($orden); // Verificar los datos antes de pasarlos a la vista
        $tipoanalisis = TipoAnalisis::all();
        $bioquimico = Bioquimico::all();
        $paciente = Paciente::all();
        return view('Orden.index', compact('ordenesConAnalisis','user', 'paciente', 'datosOrdenAnalisis', 'orden', 'tipoanalisis', 'bioquimico', 'heads'));
    }

    public function index1(Request $request)
    {
        $user = Auth::user();
        $paciente = Paciente::where('idUser', $user->id)->first();
        $heads = [
            'Id',
            'Nro Orden',
            'Tipo Analisis',
            'Fecha',
            'Paciente',
            'Estado',

            ['label' => 'Acciones', 'no-export' => true],
        ];
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($start_date && $end_date) {
            // Se proporcionó un rango de fechas, aplicar el filtro
            $orden = Orden::whereDate('created_at', '>=', $start_date)
                ->whereDate('created_at', '<=', $end_date)
                ->get();
        }


        if($paciente){
$ordenesConAnalisis = Orden::with('ordenAnalisis')->get();
$datosOrdenAnalisis = OrdenAnalisis::with('tipoAnalisis')->get();
        }else{

            $ordenesConAnalisis = Orden::with('ordenAnalisis')->get();
            $datosOrdenAnalisis = OrdenAnalisis::with('tipoAnalisis')->get();
        }
        // dd($orden); // Verificar los datos antes de pasarlos a la vista
        $tipoanalisis = TipoAnalisis::all();
        $bioquimico = Bioquimico::all();
        $paciente = Paciente::all();
        return view('Orden.index', compact('start_date', 'end_date','ordenesConAnalisis','user', 'paciente', 'datosOrdenAnalisis', 'orden', 'tipoanalisis', 'bioquimico', 'heads'));


    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   $user = Auth::user();
        $seguros = TipoSeguro::all();

        $hemogramacompleto=HemogramaCompleto::all();
        $hormonas=Hormonas::all();

        $paciente = Paciente::where('idUser', $user->id)->first();
        if($paciente){
        $seguropaciente = TipoSeguro::find($paciente->idTipoSeguro);
        }else{
            $seguropaciente = TipoSeguro::all();

        }
        $orden = Orden::all();
        $ordenesConAnalisis = Orden::with('ordenAnalisis')->get();
        $datosOrdenAnalisis = OrdenAnalisis::with('tipoAnalisis')->get();
        $tipoanalisisT = TipoAnalisis::all();
        $tipoanalisis = analisistotal::all();

        return view('orden.create', compact('seguros','seguropaciente',
        'hemogramacompleto','hormonas','paciente','tipoanalisis','tipoanalisisT', 'user','orden', 'datosOrdenAnalisis', 'ordenesConAnalisis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if($request->pacientes=="nada"){
        $paciente = Paciente::where('idUser', $user->id)->first();
        if(!$paciente){
        $paciente = new Paciente();
        $paciente->ci = $request->ci;
        $paciente->nombre = $request->paciente;
        $paciente->sexo = $request->sexo;
        $paciente->correo = $request->correo;
        $paciente->telefono = $request->celular;
        $paciente->fechaNacimiento = $request->fechanacimiento;
        $paciente->idTipoSeguro = $request->tiposeguro;
        $usern = new User();
        $usern->name=$request->paciente;
        $usern->email=$request->correo;
        $usern->password=bcrypt($request->ci);
        $usern->save();
        $usern->assignRole('Paciente');
        $paciente->idUser = $usern->id;
        $paciente->save();
        $idpaciente = $paciente->id;

        $orden = new Orden();
        $orden->idPaciente = $idpaciente;
        $orden->save();
        // Después de guardar la orden, obtén el ID asignado
        $idOrden = $orden->id;
        // Asigna el número de orden con 'OR' concatenado con el ID
        $orden->nroOrden = 'OR' . $idOrden;
        $orden->save();
        }else{
            $orden = new Orden();
            $orden->idPaciente = $paciente->id;
            $orden->save();
            // Después de guardar la orden, obtén el ID asignado
            $idOrden = $orden->id;
            // Asigna el número de orden con 'OR' concatenado con el ID
            $orden->nroOrden = 'OR' . $idOrden;
            $orden->save();
        }
    }else{
        $orden = new Orden();
        $orden->idPaciente = $request->pacientes;
        $orden->save();
        // Después de guardar la orden, obtén el ID asignado
        $idOrden = $orden->id;
        // Asigna el número de orden con 'OR' concatenado con el ID
        $orden->nroOrden = 'OR' . $idOrden;
        $orden->save();
    }


        $tipoAnalisisIds = $request->input('analisisIdsT'); // Suponiendo que tienes un array de IDs de tipo de análisis desde el formulario
        foreach ($tipoAnalisisIds as $tipoAnalisisId) {
            // Insertar en la tabla intermedia
            DB::table('orden_analisis')->insert([
                'orden_id' => $idOrden,
                'tipo_analisis_id' => $tipoAnalisisId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Obtener el nombre del tipo de análisis utilizando el ID
            $tipoAnalisis = TipoAnalisis::find($tipoAnalisisId);

            // Crear un nuevo análisis para la orden
            $analisis = new Analisis();
            $analisis->estado = 'Pendiente';
            $analisis->descripcion =  $tipoAnalisis->nombre; // Acceder al nombre del tipo de análisis
            $analisis->idOrden = $idOrden;
            $analisis->save();
        }

        $selectedIds = $request->input('analisisIds', []);
        // Asociar los análisis seleccionados con la nueva orden
        foreach ($selectedIds as $id) {
            $t = new Selectanalisis();
            $t->idTipoanalisis = $id;
            $t->idOrden = $idOrden;
            $t->save();
        }
        activity()
            ->causedBy(auth()->user())
            ->withProperties(request()->ip())
            ->log('Se registró un análisis para la orden con el ID: ' . $idOrden);

        session()->flash('success', 'Se registró exitosamente');
        if ($user->hasRole('Paciente')) {
            return redirect()->route('orden.index')->with('success', '¡El análisis se ha registrado exitosamente!');

            // El usuario tiene el rol de "Paciente"
            // Puedes colocar aquí el código que deseas ejecutar para usuarios con este rol
        } else {
            return redirect()->route('analisis.index')->with('success', '¡El análisis se ha registrado exitosamente!');

            // El usuario no tiene el rol de "Paciente"
            /// Puedes colocar aquí el código que deseas ejecutar para usuarios sin este rol
        }
    }


    // $idOrden = $request->idOrden;
    // if ($idOrden == null) {
    //     $orden = new Orden();
    //     $orden->idPaciente=$request->idPaciente;
    //     $orden->save();
    //     $idOrden = $orden->id;
    // }

    // // Registrar la relación en la tabla intermedia orden_analisis
    // $tipoAnalisisIds = $request->input('tipoAnalisisIds'); // Suponiendo que tienes un array de IDs de tipo de análisis desde el formulario
    // foreach ($tipoAnalisisIds as $tipoAnalisisId) {
    //     // Insertar en la tabla intermedia
    //     DB::table('orden_analisis')->insert([
    //         'orden_id' => $idOrden,
    //         'tipo_analisis_id' => $tipoAnalisisId,
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     ]);

    //     // Obtener el nombre del tipo de análisis utilizando el ID
    //     $tipoAnalisis = TipoAnalisis::find($tipoAnalisisId);

    //     // Crear un nuevo análisis para la orden
    //     $analisis = new Analisis();
    //     $analisis->idBioquimico = $request->idBioquimico;
    //     $analisis->estado = 'Pendiente';
    //     $analisis->descripcion =  $tipoAnalisis->nombre; // Acceder al nombre del tipo de análisis
    //     $analisis->idOrden = $idOrden;
    //     $analisis->save();
    // }
    // activity()
    //     ->causedBy(auth()->user())
    //     ->withProperties(request()->ip())
    //     ->log('Se registró un análisis para la orden con el ID: ' . $idOrden);

    // session()->flash('success', 'Se registró exitosamente');
    // return redirect()->route('orden.index')->with('success', '¡El análisis se ha registrado exitosamente!');


    /**
     * Display the specified resource.
     */
    public function show(Orden $orden)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orden $orden)
    {
        $user = Auth::user();
        $seguros = TipoSeguro::all();

        $paciente = Paciente::where('idUser', $user->id)->first();
        if($paciente){
        $seguropaciente = TipoSeguro::find($paciente->idTipoSeguro);
        }else{
            $seguropaciente = TipoSeguro::all();

        }
        $orden = Orden::where('id', $orden->id)->first();
        $ordenesConAnalisis = Orden::with('ordenAnalisis')->get();
        $datosOrdenAnalisis = OrdenAnalisis::with('tipoAnalisis')->get();
        $tipoanalisis = TipoAnalisis::all();

        return view('Orden.edit', compact('seguros','seguropaciente', 'paciente','tipoanalisis', 'user','orden', 'datosOrdenAnalisis', 'ordenesConAnalisis'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->pacientes=="nada"){
            $user = Auth::user();
            $paciente = Paciente::where('idUser', $user->id)->first();
            if(!$paciente){
            $paciente = new Paciente();
            $paciente->ci = $request->ci;
            $paciente->nombre = $request->paciente;
            $paciente->sexo = $request->sexo;
            $paciente->correo = $request->correo;
            $paciente->telefono = $request->celular;
            $paciente->fechaNacimiento = $request->fechanacimiento;
            $paciente->idTipoSeguro = $request->tiposeguro;
            $usern = new User();
            $usern->name=$request->paciente;
    $usern->email=$request->correo;
    $usern->password=bcrypt($request->ci);
        $usern->save();
    $usern->assignRole('Paciente');
            $paciente->idUser = $usern->id;
            $paciente->save();
            $idpaciente = $paciente->id;


            }else{

            }
        }else{

        }


            $tipoAnalisisIds = $request->input('tipoAnalisisIds'); // Suponiendo que tienes un array de IDs de tipo de análisis desde el formulario
            foreach ($tipoAnalisisIds as $tipoAnalisisId) {
                // Insertar en la tabla intermedia
                DB::table('orden_analisis')->insert([
                    'orden_id' => $id,
                    'tipo_analisis_id' => $tipoAnalisisId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Obtener el nombre del tipo de análisis utilizando el ID
                $tipoAnalisis = TipoAnalisis::find($tipoAnalisisId);

                // Crear un nuevo análisis para la orden
                $analisis = new Analisis();
                $analisis->estado = 'Pendiente';
                $analisis->descripcion =  $tipoAnalisis->nombre; // Acceder al nombre del tipo de análisis
                $analisis->idOrden = $id;
                $analisis->save();
            }
            activity()
                ->causedBy(auth()->user())
                ->withProperties(request()->ip())
                ->log('Se ACTUALIZO un análisis para la orden con el ID: ' . $id);

            session()->flash('success', 'Se registró exitosamente');
            return redirect()->route('Orden.index')->with('success', '¡El análisis se ha registrado exitosamente!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orden $orden)
    {
        activity()
        ->causedBy(auth()->user())
        ->withProperties(request()->ip())
        ->log('Se elimino un análisis para la orden con el ID: ' . $orden->id);
        $orden->delete();
        return redirect()->route('orden.index')->with('success', 'Eliminado correctamente');
    }
}
