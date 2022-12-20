@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content')
    @livewire('admin.areas.areas-edit', ['area' => $area], key($area->id))
@stop

@section('css')
    
@stop

@section('js')
    
@stop