@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    <div class="py-4">
        @livewire('admin.admonitions.admonitions-edit', ['admonition' => $admonition], key($admonition->id))
    </div>
    
@stop

@section('css')

@stop

@section('js')

@stop
