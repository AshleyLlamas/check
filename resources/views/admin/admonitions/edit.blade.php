@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content')
    @livewire('admin.admonitions.admonitions-edit', ['admonition' => $admonition], key($admonition->id))
@stop

@section('css')
    
@stop

@section('js')
    
@stop