@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    @livewire('admin.admonition-types.admonition-types-edit', ['admonition_type' => $admonition_type], key($admonition_type->id))
@stop

@section('css')

@stop

@section('js')

@stop
