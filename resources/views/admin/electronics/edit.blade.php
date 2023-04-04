@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    @livewire('admin.electronics.electronics-edit', ['electronic' => $electronic], key($electronic->id))
@stop

@section('css')

@stop

@section('js')

@stop
