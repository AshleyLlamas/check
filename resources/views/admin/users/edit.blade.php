@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    @livewire('admin.users.users-edit', ['user' => $user], key($user->id))
@stop

@section('css')

@stop

@section('js')

@stop
