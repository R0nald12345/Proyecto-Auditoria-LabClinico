<?php

namespace Database\Seeders;

use App\Models\analisistotal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodosanalisisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Hemograma Completo
        $hemogramaAtributos = [
            'globulosRojos' => 30.00,
            'hematocrito' => 25.00,
            'hemoglobina' => 20.00,
            'VCM' => 15.00,
            'HCM' => 15.00,
            'CHCM' => 20.00,
            'VSG' => 40.00,
            'recuento' => 35.00,
            'plaquetas' => 35.00,
            'globulosBlancos' => 50.00,
            'promielocitos' => 45.00,
            'mielocitos' => 45.00,
            'metamielocitos' => 40.00,
            'cayados' => 30.00,
            'segmentados' => 30.00,
            'linfocitos' => 25.00,
            'monocitos' => 25.00,
            'eosinofilos' => 20.00,
            'basofilos' => 20.00,
            'blastos' => 30.00,
            'grupoSanguineo' => 50.00,
            'factorRh' => 45.00,
            'VDRL' => 45.00, // Añade los valores restantes con sus respectivos nombres
            'baciloscopia' => 100.00,
            'coproparasitologico' => 10.00,
            'metodo' => 100.00,
            'resultado' => 10.00,
        ];

        foreach ($hemogramaAtributos as $atributo => $precio) {
            analisistotal::create([
                'nombre' => $atributo,
                'descripcion' => 'General',
                'precio' => $precio,
                'tipo' => 'Hemograma',
            ]);
        }

        // Hormonas
        $hormonasAtributos = [
            'TSH' => 100.00,
            'T3' => 90.00,
            'T4' => 90.00,
            'TSHNeonatal' => 110.00,
            'T4Libre' => 100.00,
            'progesterona' => 120.00,
            'prolactina' => 110.00,
            'estradiol' => 130.00,
            'cortisol8am' => 125.00,
            'cortisol6pm' => 125.00,
            'LH' => 115.00,
            'FSH' => 115.00,
            'testosterona' => 140.00,
            'testosteronaTotal' => 140.00,
            'testosteronaLibre' => 150.00,
            'HDeCrecimiento' => 160.00,
            'HDeCrecimientoPostEjercicio' => 160.00,
            'insulina' => 130.00,
            'AcAntiTPO' => 170.00,
            'AcAntiTg' => 170.00,
            'DHEA' => 180.00,
            'DHEAS' => 180.00,
            '17OHP' => 190.00,
            'PRL' => 190.00,
            'gastrina' => 200.00,
            'aldosterona' => 200.00,
            'HParatiroidea' => 210.00,
            'anAntitiroglobulinaTG' => 210.00,
            'acVanilMandelico' => 220.00,
            'IGFSomatomedinaC' => 220.00,
            'IGFBP3' => 230.00,
            'insulinaPostPand' => 230.00,
        ];

        foreach ($hormonasAtributos as $atributo => $precio) {
            analisistotal::create([
                'nombre' => $atributo,
                'descripcion' => 'General',
                'precio' => $precio,
                'tipo' => 'Hormona',
            ]);
        }

        // Química Sanguínea
        $quimicaAtributos = [
            'glucosa' => 50.00,
            'urea' => 60.00,
            'creatinina' => 70.00,
            'acidoUrico' => 80.00,
            'colesterol' => 90.00,
            'trigliceridos' => 100.00,
            'colesterolHDL' => 110.00,
            'colesterolLDL' => 120.00,
            'colesterolVLDL' => 130.00,
            'lipidoTotales' => 140.00,
            'fosfolipidos' => 150.00,
            'proteinasTotales' => 210.00,
            'albuminas' => 190.00,
            'globulina' => 200.00,
            'cloro' => 260.00,
            'sodio' => 240.00,
            'potasio' => 250.00,
            'calcio' => 220.00,
            'calcioIonico' => 0.00, // Añade los valores restantes con sus respectivos nombres
            'troponina' => 0.00,
            'ferritina' => 0.00,
            'transferrina' => 0.00,
            'fosforo' => 230.00,
            'hierro' => 280.00,
            'litio' => 290.00,
            'magnesio' => 270.00,
            'amilasa' => 310.00,
            'lipasa' => 320.00,
            'transaminasaGOT' => 330.00,
            'transaminasaGPT' => 340.00,
            'fosfatasaAlcalina' => 150.00,
            'fosfAcidaTotal' => 360.00,
            'fostAcidaProstatica' => 370.00,
            'creatinFosfoKinasaCPK' => 380.00,
            'deshidrogemasaLacticaLDH' => 390.00,
        ];

        foreach ($quimicaAtributos as $atributo => $precio) {
            analisistotal::create([
                'nombre' => $atributo,
                'descripcion' => 'General',
                'precio' => $precio,
                'tipo' => 'Quimica',
            ]);
        }

        // Orina Completa
        $orinaAtributos = [
            'volumen' => 30.00,
            'color' => 25.00,
            'aspecto' => 20.00,
            'densidad' => 15.00,
            'ph' => 20.00,
            'olor' => 0.00, // Añadir los valores restantes con sus respectivos nombres
            'proteinas' => 25.00,
            'glucosa' => 30.00,
            'cetonas' => 35.00,
            'urobilinogeno' => 40.00,
            'hemoglobina' => 45.00,
            'nitritos' => 50.00,
            'bilirrubina' => 55.00,
            'sangre' => 60.00,
            'celulasEpiteliales' => 65.00,
            'eritrocitos' => 0.00,
            'leucocitos' => 70.00,
            'bacterias' => 75.00,
            'filamentosDeMucus' => 80.00,
            'cristalesUratosAmorfes' => 0.00,
            'cristalesOxalatoDeCalcio' => 85.00,
            'cristalesFosfatosAmorfos' => 90.00,
            'cristalesDeAcidoUrico' => 95.00,
            'cilindrosHialino' => 0.00,
            'cilindrosGranuloso' => 100.00,
            'cilindrosLeucocitario' => 0.00,
            'levaduras' => 105.00,
            'fosfTripleDeAmonioYMagnesio' => 0.00,
        ];
        
        foreach ($orinaAtributos as $atributo => $precio) {
            analisistotal::create([
                'nombre' => $atributo,
                'descripcion' => 'General',
                'precio' => $precio,
                'tipo' => 'Orina',
            ]);
        }
    }
}
