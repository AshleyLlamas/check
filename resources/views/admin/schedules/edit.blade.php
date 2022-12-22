@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content')
    @livewire('admin.schedules.schedules-edit', ['schedule' => $schedule], key($schedule->id))
@stop

@section('css')
    
@stop

@section('js')
    
@stop