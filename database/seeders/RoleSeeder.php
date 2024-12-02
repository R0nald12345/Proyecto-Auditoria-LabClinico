<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Recepcionista']);
        $role3 = Role::create(['name' => 'Bioquimico']);
        $role4 = Role::create(['name' => 'Paciente']);

        // Routes Admin.php
        Permission::create(['name' => 'home'])->syncRoles([$role1, $role2, $role3]);

        //Paquete Usuarios
        Permission::create(['name' => 'users.package'])->syncRoles([$role1]);

        //Usuarios
        Permission::create(['name' => 'users.index'])->syncRoles([$role1]);
        //Bioquimicos
        Permission::create(['name' => 'bioquimicos.index'])->syncRoles([$role1]);
        //Roles
        Permission::create(['name' => 'roles.index'])->syncRoles([$role1]);
        //Bitacora
        Permission::create(['name' => 'bitacora.index'])->syncRoles([$role1]);

        //Paquete historiales
        Permission::create(['name' => 'history.package'])->syncRoles([$role1, $role2]);

        //Pacientes
        Permission::create(['name' => 'pacientes.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'pacientes.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'pacientes.store'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'pacientes.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'pacientes.update'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'pacientes.destroy'])->syncRoles([$role1, $role2]);

        //Historiales
        Permission::create(['name' => 'historiales.index'])->syncRoles([$role1, $role2]);

        //TipoSeguro
        Permission::create(['name' => 'tiposeguro.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'tiposeguro.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'tiposeguro.store'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'tiposeguro.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'tiposeguro.update'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'tiposeguro.destroy'])->syncRoles([$role1, $role2]);

        //Paquete analisis
        Permission::create(['name' => 'analysis.package'])->syncRoles([$role1,$role3,$role4]);

        //orden
        Permission::create(['name' => 'orden.index'])->syncRoles([$role1, $role3, $role4]);
        Permission::create(['name' => 'paciente.index'])->syncRoles([$role4]);

        //analisis
        Permission::create(['name' => 'analisis.index'])->syncRoles([$role1, $role3]);
        //TipoAnalisis
        Permission::create(['name' => 'tipoanalisis.index'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'tipoanalisis.create'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'tipoanalisis.store'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'tipoanalisis.edit'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'tipoanalisis.update'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'tipoanalisis.destroy'])->syncRoles([$role1, $role3]);


        //recepcionistas
        Permission::create(['name' => 'recepcionistas.index'])->syncRoles([$role1]);

        //especialidades
        Permission::create(['name' => 'especialidad.index'])->syncRoles([$role1, $role2]);

        //landingPage
        Permission::create(['name' => 'landingpage.index'])->syncRoles([$role1, $role2, $role3, $role4]);









    }
}
