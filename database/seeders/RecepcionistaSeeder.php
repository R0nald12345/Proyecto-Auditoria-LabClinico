<?php

namespace Database\Seeders;

use App\Models\Recepcionista;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecepcionistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::create([
            'name' => 'Juan Perez',
            'email' => 'juan@gmail.com',
            'password' => '12345',
        ]);

        $user2 = User::create([
            'name' => 'Maria Lopez',
            'email' => 'maria@gmail.com',
            'password' => '12345',
        ]);

        $recepcionista = new Recepcionista();
        $recepcionista->ci = '9825263';
        $recepcionista->nombre = $user1->name; // Corregido
        $recepcionista->fechaNacimiento = '1990-01-01';
        $recepcionista->sexo = 'M';
        $recepcionista->telefono = '78520369';
        $recepcionista->direccion = 'Roca y Coronado';
        $recepcionista->idUsuario = $user1->id; 
        $recepcionista->save();

        $recepcionista = new Recepcionista();
        $recepcionista->ci = '5863251';
        $recepcionista->nombre = $user2->name; // Corregido
        $recepcionista->fechaNacimiento = '2005-01-02';
        $recepcionista->sexo = 'F';
        $recepcionista->telefono = '74101010';
        $recepcionista->direccion = 'Calle 2';
        $recepcionista->idUsuario = $user2->id; 
        $recepcionista->save();
    }
}
