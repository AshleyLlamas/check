@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    @livewire('admin.computers.computers-edit', ['computer' => $computer], key($computer->id))
@stop

@section('css')

@stop

@section('js')

@stop
