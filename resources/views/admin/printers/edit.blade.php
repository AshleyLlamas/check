@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content')
    @livewire('admin.printers.printers-edit', ['printer' => $printer], key($printer->id))
@stop

@section('css')

@stop

@section('js')

@stop
