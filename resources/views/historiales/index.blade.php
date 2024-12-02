@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">historial de {{Auth::user()->name}}</h1>
    {{-- @vite('resources/css/app.css') --}}
@stop


a
@section('content')

<div class="card">
    <div class="card-body">

        <x-adminlte-datatable id="table1" :heads="$heads" striped head-theme="white" with-buttons>


            @foreach($historiales as $historial)
                <tr>
                        <td>{{ $historial->historial->nroHistoria }}</td>
                        <td>{{ $historial->tipo_analisis }}</td>
                        <td>{{ $historial->fecha}}</td>
                        <td>{{ $historial->doctor }}</td>
                        <td>{{ $historial->precion_arterial }}</td>
                        <td>{{ $historial->peso }}</td>
                        <td>{{ $historial->altura }}</td>
                        <td width="15px">
                            <div class="d-flex">
                                <button class="btn btn-xs btn-default text-teal mx-1 shadow" title="ELIMINAR" data-toggle="modal" data-target="#modalCustom{{ $historial->id }}">
                                    <i class="fa fa-lg fa-fw fa-eye"></i>
                                </button>

                            </div>
                        </td>
                        <x-adminlte-modal id="modalCustom{{$historial->id }}" title="Mostrar" theme="warning" v-centered static-backdrop scrollable>

                            <x-adminlte-textarea name="taDisabled" rows=10 disabled>
                            {{ $historial->notas }}
                            </x-adminlte-textarea>
                            <x-slot name="footerSlot">
                                <x-adminlte-button theme="light" label="Cerrar" data-dismiss="modal" />
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

@stop
