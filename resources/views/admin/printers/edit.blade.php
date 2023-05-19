@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    <div class="py-4">
        @livewire('admin.printers.printers-edit', ['printer' => $printer], key($printer->id))
    </div>
    
@stop

@section('css')

@stop

@section('js')

@stop
