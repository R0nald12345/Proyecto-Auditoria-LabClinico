@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">BIOQUIMICOS</h1>
@stop



@section('content')

{{-- @if (session('mensaje'))
<div class="swalDefaultWarning">
    <strong>{{ session('mensaje') }}</strong>
</div>
@endif --}}

{{-- modal --}}
<div class="form-group align-items-end">
        {{-- ---Custom modal-- --}}
        <x-adminlte-button label="Registrar nuevo bioquimico" class="bg-white" title="Registrar nuevo bioquimico"
        data-toggle="modal" data-target="#modalpromocion" />

        <x-adminlte-modal id="modalpromocion" title="Registrar Bioquimico" size="lg" theme="dark" v-centered static-backdrop scrollable>
            <form action="{{ route('bioquimicos.store') }}" method="POST">
                        @method('POST')
                        @csrf
                                <x-adminlte-input name="ci" type="text" label="carnet de identidad" />
                                <x-adminlte-input name="direccion" type="text" label="direccion del bioquimico" />
                                <x-adminlte-input name="nombre" type="text" label="Nombre del bioquimico" />
                                <x-adminlte-input name="fechaNacimiento" type="date" label="fecha nacimiento"/>
                                <x-adminlte-select name="sexo" label="sexo" required>
                                    <option disabled>Seleccione una opcion</option>
                                    <option value="MASCULINO" selected>MASCULINO</option>
                                    <option value="FEMENINO" selected>FEMENINO</option>
                                </x-adminlte-select>
                                <x-adminlte-input name="telefono" type="text" label="Telefono" />
                                <label for="idEspecialidad">Especialidad</label>
                                <x-adminlte-select name="idEspecialidad" id="idEspecialidad" required>
                                    @foreach ($Especialidad as $seguro)
                                    <option value="{{$seguro->id}}">{{$seguro->descripcion}}</option>
                                    @endforeach

                                </x-adminlte-select>
                                <x-adminlte-input name="email" type="email" label="correo electronico"/>
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


            @foreach($Bioquimico as $paciente)
                <tr>

                        <td>{{ $paciente->ci }}</td>
                        <td>{{ $paciente->direccion }}</td>
                        <td>{{ $paciente->nombre }}</td>
                        <td>{{ $paciente->fechaNacimiento }}</td>
                        <td>{{ $paciente->sexo }}</td>
                        <td>{{ $paciente->telefono }}</td>
                        <td>{{ $paciente->Especialidad->descripcion }}</td>
                        <td width="15px">
                            <div class="d-flex">

                                {{-- esto es para el de editar membresía --}}
                                <a href="{{route('bioquimicos.edit', $paciente) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="EDITAR">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </a>

                                <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="ELIMINAR" data-toggle="modal" data-target="#modalCustom{{ $paciente->id }}">
                                    <i class="fa fa-lg fa-fw fa-trash"></i>
                                </button>
                                <a href="{{ route('bioquimicos.show', $paciente) }}" class="btn btn-xs btn-default text-teal mx-1 shadow" title="DETALLES">
                                    <i class="fa fa-lg fa-fw fa-eye"></i>
                                </a>

                                <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="horario" data-toggle="modal" data-target="#modalCustom1{{ $paciente->id }}">
                                    <i class="fa-solid fa-file-medical"></i>
                                </button>


                            </div>
                        </td>
                        <x-adminlte-modal id="modalCustom1{{ $paciente->id }}" title="HORARIOS" size="lg" theme="dark" v-centered static-backdrop scrollable>
                            <form action= "{{ route('bioquimico.horario', $paciente) }}" method="GET">
                                        @method('POST')
                                        @csrf
                                        <div class="col">
                                            <span style="background-color: #cecece; padding: 10px; border-radius: 5px; display: inline-block;">
                                             Horarios para el bioquimico:  @foreach ($Bioquimico as $hemograma)
@if($hemograma->id == $paciente->id)
                                                 <label class="form-check-label" for="analisis{{ $hemograma->id }}">
                                                     {{ $hemograma->nombre }}
                                                 </label>
@endif
                                     @endforeach
                                         </span>

                                         <div class="input-group">
                                             <br>
                                             <div>
                                     @foreach ($horario as $hemograma)

                                             <div class="form-check">
                                                 <input class="form-check-input" type="checkbox" value="{{ $hemograma->id }}" id="analisis{{ $hemograma->id }}" name="analisisIds[]">
                                                 <label class="form-check-label" for="analisis{{ $hemograma->id }}">
                                                     {{ $hemograma->dia }} : {{ $hemograma->horarioEntrada }} - {{ $hemograma->horarioSalida }}
                                                 </label>
                                             </div>

                                     @endforeach
                                         </div>
                                         </div>
                                     </div>
                                                <x-adminlte-button  class="float-left mt-3" type="submit" label="Aceptar" theme="dark" />
                                                <x-adminlte-button  class="btn btn-primary float-right mt-3" theme="light" label="Cancelar" data-dismiss="modal" />


                                                <x-slot name="footerSlot" >
                                                </x-slot>
                            </form>
                        </x-adminlte-modal>
                        <x-adminlte-modal id="modalCustom{{ $paciente->id }}" title="Eliminar" size="sm" theme="warning" icon="fa-solid fa-triangle-exclamation" v-centered static-backdrop scrollable>
                            <div style="height: 50px;">¿Está seguro de eliminar el bioquimico?</div>
                            <x-slot name="footerSlot">
                                <form action="{{ route('bioquimicos.destroy', $paciente) }}" method="POST">
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

            // $('.swalDefaultError').click(function() {
            // Toast.fire({
            //     icon: 'error',
            //     title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            // })
            // });
            // $('.swalDefaultWarning').click(function() {
            // Toast.fire({
            //     icon: 'warning',
            //     title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            // })
            // });
            // $('.swalDefaultQuestion').click(function() {
            // Toast.fire({
            //     icon: 'question',
            //     title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            // })
            // });
        });

    </script>
@stop
