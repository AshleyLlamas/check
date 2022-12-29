@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content')
    <div class="py-4">
        @livewire('admin.roles.roles-show', ['role' => $role], key($role->id))
    </div>
@stop