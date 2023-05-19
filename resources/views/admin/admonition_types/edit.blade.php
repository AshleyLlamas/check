@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    <div class="py-4">
        @livewire('admin.admonition-types.admonition-types-edit', ['admonition_type' => $admonition_type], key($admonition_type->id))
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
