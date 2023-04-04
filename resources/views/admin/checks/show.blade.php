@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    <div class="py-4">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                @can('admin.checks.index')
                    <li class="breadcrumb-item"><a href="{{route('admin.checks.index')}}">Todos los checadores</a></li>
                @endcan
                <li class="breadcrumb-item active">Ver Checador</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-center mb-1">Checador</h5>
            </div>
            <div class="card-body">
                <div class="p-3 text-center row">
                    <div class="col">
                        <div class="border rounded bg-light p-4 h-100">
                            <h5 class="mb-1"><b><i class="fa-solid fa-user"></i> Usuario:</b><br>
                                @can('admin.users.show')
                                    <a href="{{route('admin.users.show', $check->user)}}">{{$check->user->name}}</a>
                                @else
                                    <p class="text-secondary">
                                        {{$check->user->name}}
                                    </p>
                                @endcan
                            </h5>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border rounded bg-light p-4 h-100">
                            <h5 class="mb-1"><b><i class="fa-regular fa-calendar"></i> Fecha:</b><br> <p class="text-secondary">{{$check->fecha->formatlocalized('%d/%m/%Y')}}</p></h5>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col">
                        <table class="table table-borderless rounded">
                            <thead class="border-bottom">
                                <tr>
                                    <th scope="col" class="border-right"><i class="fa-solid fa-door-open"></i></th>
                                    <th scope="col"><i class="fa-solid fa-clock"></i> Hora</th>
                                    <th scope="col"><i class="fa-solid fa-magnifying-glass"></i> Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($check->in)
                                    <tr class="border-bottom">
                                        <th scope="col" class="border-right">Entrada @isset($check->schedule) ({{$check->schedule->hora_de_entrada->format('h:i A')}}) @endisset</th>
                                        <th scope="row">{{$check->in->hora->format('h:i:s A')}}</th>
                                        <td>{{$check->in->estatus}}</td>
                                    </tr>
                                @endisset
                                @isset($check->out)
                                    <tr class="border-bottom">
                                        <th scope="col" class="border-right">Salida @isset($check->schedule) ({{$check->schedule->hora_de_salida->format('h:i A')}}) @endisset</th>
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
