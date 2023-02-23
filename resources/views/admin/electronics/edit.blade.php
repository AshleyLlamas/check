@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content')
    @livewire('admin.electronics.electronics-edit', ['electronic' => $electronic], key($electronic->id))
@stop

@section('css')

@stop

@section('js')

@stop
