@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    @livewire('admin.roles.roles-edit', ['role' => $role], key($role->id))
@stop

@section('css')

@stop

@section('js')

@stop
