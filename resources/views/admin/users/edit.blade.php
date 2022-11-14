@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content')
    @livewire('admin.users.users-edit', ['user' => $user], key($user->id))
@stop

@section('css')
    
@stop

@section('js')
    
@stop