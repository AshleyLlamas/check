@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    <div class="py-4">
        @livewire('admin.roles.roles-show', ['role' => $role], key($role->id))
    </div>
@stop
