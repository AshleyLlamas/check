@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    <div class="py-4">
        @can('admin.home.info')
            @livewire('admin.home.control-de-asistencias')
        @endcan
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
