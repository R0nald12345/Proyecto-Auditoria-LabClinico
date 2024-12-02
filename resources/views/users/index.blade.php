@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
<h1 class="m-0 text-dark">Usuarios</h1>
@stop

@section('content')
<a href="{{route('users.create')}}" class="btn btn-success">Crear Usuario</a>

<div class="card">
    <div class="card-body">

        <x-adminlte-datatable id="table1" :heads="$heads" striped head-theme="white" with-buttons>


            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @php
                        $roles = $user->roles->pluck('name')->toArray();
                        $rolString = implode(', ', $roles);
                    @endphp
                    {{ $rolString }}
                </td>
                <td width="15px">
                    <div class="d-flex">

                        {{-- esto es para el de editar membresía --}}
                        <a href="{{route('users.edit', $user) }}"
                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="EDITAR">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>

                        <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="ELIMINAR"
                            data-toggle="modal" data-target="#modalCustom{{ $user->id }}">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                        <a href="{{ route('pacientes.show', $user) }}"
                            class="btn btn-xs btn-default text-teal mx-1 shadow" title="DETALLES">
                            <i class="fa fa-lg fa-fw fa-eye"></i>
                        </a>


                    </div>
                </td>

                <x-adminlte-modal id="modalCustom{{ $user->id }}" title="Eliminar" size="sm" theme="warning"
                    icon="fa-solid fa-triangle-exclamation" v-centered static-backdrop scrollable>
                    <div style="height: 50px;">¿Está seguro de eliminar al usuario?</div>
                    <x-slot name="footerSlot">
                        <form action="{{ route('users.destroy', $user) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <x-adminlte-button class="btn-flat" type="submit" label="Aceptar" theme="dark" />
                        </form>
                        <x-adminlte-button theme="light" label="Cancelar" data-dismiss="modal" />
                    </x-slot>
                </x-adminlte-modal>

            </tr>
            @endforeach

        </x-adminlte-datatable>

    </div>
</div>
@stop

@section('plugins.DatatablesPlugin', true)
@section('plugins.Datatables', true)

@section('css')
<link rel="stylesheet" href="{{ asset('css/fontawesome-free-6.5.2-web/css/all.min.css')}}">
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $(function() {
            var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
            });
            @if (session('success'))
            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            });
            @endif
             
            @if (session('deleted'))
            Toast.fire({
                icon: 'info',
                title: '{{ session('deleted') }}'
            });
            @endif
            
        });

</script>
@stop