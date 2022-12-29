@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content')
    @livewire('admin.roles.roles-edit', ['role' => $role], key($role->id))
@stop

@section('css')
    
@stop

@section('js')
    
@stop