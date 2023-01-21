@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content')
    @livewire('admin.vacations.vacations-edit', ['vacation' => $vacation], key($vacation->id))
@stop

@section('css')
    
@stop

@section('js')
    
@stop