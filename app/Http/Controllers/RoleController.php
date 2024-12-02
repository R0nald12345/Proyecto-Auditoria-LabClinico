<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heads = [
            'ID',
            'Nombre',
            ['label' => 'Acciones', 'no-export' => true],
        ];
        $roles = Role::all();
        $permisos = Permission::all();
        return view('roles.index', compact('heads', 'roles', 'permisos'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255|unique:roles,name',
            'permisos' => 'array|required',
            'permisos.*' => 'exists:permissions,id', // Asegura que los permisos existan en la tabla permissions
        ]);

        // Crear el nuevo rol
        $rol = Role::create([
            'name' => $request->nombre,
            'guard_name' => 'web', // Puedes cambiar el guard_name según tu configuración
        ]);

        // Asignar permisos al rol
        $rol->permissions()->sync($request->permisos);
        activity()
        ->causedBy(auth()->user())
        ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
        ->log('Registro un rol: ' . $rol->name);
    session()->flash('success', 'Se registró exitosamente');
        // Redireccionar o devolver una respuesta JSON según tus necesidades
        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente');
    }

    public function show(Role $role)
    {
        // Cargar los permisos asociados al rol
        $role->load('permissions');
        $permisos = Permission::all();
        // Devolver la vista de detalles del rol con los datos del rol cargados
        return view('roles.show', compact('role', 'permisos'));
    }

    public function edit(Role $role)
    {
        // Obtener todos los permisos disponibles
        $permisos = Permission::all();

        return view('roles.edit', compact('role', 'permisos'));
    }

    public function update(Request $request, Role $role)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permisos' => 'array|required',
            'permisos.*' => 'exists:permissions,id', // Asegura que los permisos existan en la tabla permissions
        ]);

        // Actualizar el rol con los datos proporcionados
        $role->update([
            'name' => $request->nombre,
        ]);

        // Asignar permisos al rol
        $role->permissions()->sync($request->permisos);
        activity()
        ->causedBy(auth()->user())
        ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
        ->log('ACTUALIZO un rol: ' . $role->name);
    session()->flash('success', 'Se registró exitosamente');
        // Redireccionar al usuario a la vista de detalles del rol actualizado
        return redirect()->route('roles.show', $role)->with('success', 'Rol actualizado exitosamente');
    }

    public function destroy(Role $role)
    {
        // Verificar si existen usuarios con este rol
        if ($role->users()->exists()) {
            return redirect()->route('roles.index')->with('error', 'No se puede eliminar el rol porque hay usuarios asignados a él.');
        }

        // Eliminar la relación de permisos asociados al rol
        $role->permissions()->detach();

        // Eliminar el rol
        $role->delete();
        activity()
        ->causedBy(auth()->user())
        ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
        ->log('elimino un rol: ' . $role->name);
    session()->flash('success', 'Se registró exitosamente');
        return redirect()->route('roles.index')->with('success', 'Rol eliminado exitosamente');
    }
}
