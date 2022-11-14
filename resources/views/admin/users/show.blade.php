@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content')
<div class="py-4">
    <!-- Main content -->
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-info card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="@if($user->image) {{Storage::url($user->image->url)}} @else {{asset('recursos/foto-default.png')}} @endif"
                            alt="Fotografía">
                        </div>

                        <h3 class="profile-username text-center">{{$user->name}}</h3>

                        <p class="text-muted text-center">{{$user->puesto}}</p>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Información</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                            <strong><i class="fa-solid fa-hashtag"></i> Número del empleado</strong>

                            <p class="text-muted">
                                @isset($user->número_de_empleado)
                                    {{$user->número_de_empleado}}
                                @else
                                    N/A
                                @endisset
                            </p>
                        <hr>
                            <strong><i class="fa-solid fa-envelope"></i> Correo</strong>

                            <p class="text-muted">
                                @isset($user->email)
                                    {{$user->email}}
                                @else
                                    N/A
                                @endisset
                            </p>
                        <hr>
                            <strong><i class="fa-solid fa-fingerprint"></i> CURP</strong>

                            <p class="text-muted">
                                @isset($user->curp)
                                    {{$user->curp}}
                                @else
                                    N/A
                                @endisset
                            </p>
                        <hr>
                            <strong><i class="fa-solid fa-briefcase"></i> Compañia / Empresa</strong>

                            <p class="text-muted">
                                @isset($user->company->nombre_de_la_compañia)
                                    {{$user->company->nombre_de_la_compañia}}
                                @else
                                    N/A
                                @endisset
                            </p>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#horiario" data-toggle="tab">Horario</a></li>
                            <li class="nav-item"><a class="nav-link" href="#asistencia" data-toggle="tab">Asistencia</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="horiario">
                                    <div>
                                        <div class="table-responsive">
                                            @if($user->schedules->count())
                                                <table class="table text-center border">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="{{$user->schedules->count()+1}}"><b>Horario</b></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="bg-secondary"><i class="fa-solid fa-clock"></i></th>
                                                            @foreach ($user->schedules as $schedule)
                                                                <th class="border-left bg-secondary">{{$schedule->día}}</th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row" class="bg-light">Entrada</th>
                                                        @foreach ($user->schedules as $n => $schedule)
                                                            <td class="border-left">
                                                                {{$schedule->hora_de_entrada->format('h:i a')}}
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                        <tr>
                                                            <th scope="row" class="bg-light">Salida</th>
                                                            @foreach ($user->schedules as $n => $schedule)
                                                                <td class="border-left">
                                                                    {{$schedule->hora_de_salida->format('h:i a')}}
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            @else
                                                <p class="text-danger text-center mb-1"><b>Sin horario.</b></p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="asistencia">
                                    22
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@stop

@section('css')
    
@stop

@section('js')
    
@stop