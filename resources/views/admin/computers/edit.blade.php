@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    
    <div class="py-4">
        @livewire('admin.computers.computers-edit', ['computer' => $computer], key($computer->id))
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
