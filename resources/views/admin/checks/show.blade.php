@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content')
    <div class="py-4">
        <div class="card">
            <div class="card-header bg-info">
                <h5 class="text-center my-2">Checador</h5>
            </div>
            <div class="card-body">
                <div class="p-3 text-center row">
                    <div class="col">
                        <h5 class="mb-1"><b><i class="fa-solid fa-user"></i> Usuario:</b><br> <p class="text-secondary">{{$check->user->name}}</p></h5>
                    </div>
                    <div class="col">
                        <h5 class="mb-1"><b><i class="fa-regular fa-calendar"></i> Fecha:</b><br> <p class="text-secondary">{{$check->fecha->formatlocalized('%d-%m-%Y')}}</p></h5>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col">
                        <table class="table border rounded">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"><i class="fa-solid fa-clock"></i> Hora</th>
                                    <th scope="col">Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($check->in)
                                    <tr>
                                        <th scope="col">Entrada @isset($check->schedule) ({{$check->schedule->hora_de_entrada->format('h:i A')}}) @endisset</th>
                                        <th scope="row">{{$check->in->hora->format('h:i:s A')}}</th>
                                        <td>{{$check->in->estatus}}</td>
                                    </tr>
                                @endisset
                                @isset($check->out)
                                    <tr>
                                        <th scope="col">Salida @isset($check->schedule) ({{$check->schedule->hora_de_salida->format('h:i A')}}) @endisset</th>
                                        <th scope="row">{{$check->out->hora->format('h:i:s A')}}</th>
                                        <td>{{$check->out->estatus}}</td>
                                    </tr>
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    
@stop

@section('js')
    
@stop