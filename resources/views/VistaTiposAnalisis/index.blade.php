@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">Tipo Analisis</h1>
@stop



@section('content')



{{-- modal --}}
<div class="form-group align-items-end">
        {{-- ---Custom modal-- --}}
        <x-adminlte-button label="Registrar Analisis" class="bg-white" title="Registrar Tipo Analisis"
        data-toggle="modal" data-target="#modalpromocion" />

        <x-adminlte-modal id="modalpromocion" title="Registrar Tipo de Analisis" size="lg" theme="dark" v-centered static-backdrop scrollable>
            <form action="" method="POST">
                        @method('POST')
                        @csrf
                        <x-adminlte-input name="nombre" type="text" label="Nombre" />

                                <x-adminlte-input name="descripcion" type="text" label="Descripcion" />
                                <x-adminlte-input name="precio" type="number" label="Precio" />
                                <x-adminlte-button  class="float-left mt-3" type="submit" label="Aceptar" theme="dark" />
                                <x-adminlte-button  class="btn btn-primary float-right mt-3" theme="light" label="Cancelar" data-dismiss="modal" />

                                <x-slot name="footerSlot" >
                                </x-slot>
            </form>
        </x-adminlte-modal>
</div>
{{-- modal --}}



<div class="card">
    <div class="card-body">
        <x-adminlte-datatable id="table1" :heads="$heads" striped head-theme="white" with-buttons>
            @foreach($tipoanalisis as $t)
                <tr>

                        <td>{{ $t->id }}</td>
                        <td>{{ $t->nombre }}</td>
                        <td>{{ $t->descripcion }}</td>
                        <td>{{ $t->precio }}</td>
                        <td width="15px">
                            <div class="d-flex">

                                {{-- esto es para el de editar membresía --}}
                              {{-- esto es para el de editar membresía --}}
                              <a href="{{route('tipoanalisis.edit', $t->id) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="EDITAR">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                                <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="ELIMINAR" data-toggle="modal" data-target="#modalCustom{{ $t->id }}">
                                    <i class="fa fa-lg fa-fw fa-trash"></i>
                                </button>
                            </div>
                        </td>

                        <x-adminlte-modal id="modalCustom{{ $t->id }}" title="Eliminar" size="sm" theme="warning" icon="fa-solid fa-triangle-exclamation" v-centered static-backdrop scrollable>
                            <div style="height: 50px;">¿Está seguro de eliminar el seguro?</div>
                            <x-slot name="footerSlot">
                                <form action="{{ route('tipoanalisis.destroy', $t->id) }}" method="POST">
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
