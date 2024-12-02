@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">Quimica Sanguinea</h1>
@stop



@section('content')

<div class="card">
    <div class="card-body">
        <x-adminlte-datatable id="table1" :heads="$heads" striped head-theme="white" with-buttons>
            @foreach($quimicas as $h)
                <tr>

                    <td>{{ $h->analisis->orden->nroOrden}}</td>
                    <td>{{ $h->id }}</td>
                    <td>
                        @if ($h->analisis->bioquimico)
                            {{ $h->analisis->bioquimico->nombre }}
                        @else
                            No se registró bioquímico
                        @endif
                    </td>

                    <td>{{ $h->analisis->orden->paciente->nombre }}</td>
                    <td>{{ $h->created_at }}</td>
                        <td width="15px">
                            <div class="d-flex">

                                {{-- esto es para el de editar membresía --}}
                                <a href="{{route('quimica.edit', $h->id) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="EDITAR">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </a>
                                <a href="{{route('quimica.show', $h->id) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="EDITAR">
                                    <i class="fa fa-lg fa-fw fas fa-eye"></i>
                                </a>
                                <a href="{{route('quimica.edit', $h->id) }}" class="btn btn-xs btn-default text-danger mx-1 shadow" title="PDF">
                                    <i class="fas fa-lg fa-fw fa-file-pdf"></i>
                                </a>
                                <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="ELIMINAR" data-toggle="modal" data-target="#modalCustom{{ $h->id }}">
                                    <i class="fa fa-lg fa-fw fa-trash"></i>
                                </button>
                            </div>
                        </td>

                        <x-adminlte-modal id="modalCustom{{ $h->id }}" title="Eliminar" size="sm" theme="warning" icon="fa-solid fa-triangle-exclamation" v-centered static-backdrop scrollable>
                            <div style="height: 50px;">¿Está seguro de eliminar el seguro?</div>
                            <x-slot name="footerSlot">
                                <form action="{{ route('orina.destroy', $h->id) }}" method="POST">
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
