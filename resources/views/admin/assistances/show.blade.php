@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content')
    <div class="py-4">
        <!-- Yo -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Información de la asitencia <b> @isset($assistance->check) {{$assistance->check->fecha->format('d-m-Y')}} @else N/A @endisset </b> </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body text-center">
                    <h3>
                        @isset($assistance->user)
                            {{$assistance->user->name}}
                        @else
                            N/A
                        @endisset
                    </h3>
                <div class="row pt-2">
                    <div class="col">
                        <strong>Entrada</strong>
    
                        <p class="text-muted">
                            @isset($assistance->check->in)
                                <b>{{$assistance->check->in->hora->format('h:i:s A')}}</b>
                                <p class="mb-1">{{$assistance->check->in->estatus}}</p>
                                <p>({{$assistance->check->in->observación}})</p>
                            @else
                                N/A
                            @endisset
                        </p>
                    </div>
                    <div class="col">
                        <strong>Salida</strong>
    
                        <p class="text-muted">
                            @isset($assistance->check->out)
                                <b>{{$assistance->check->out->hora->format('h:i:s A')}}</b>
                                <p class="mb-1">{{$assistance->check->out->estatus}}</p>
                                <p>({{$assistance->check->out->observación}})</p>
                            @else
                                N/A
                            @endisset
                        </p>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@stop

@section('css')
    
@endsection