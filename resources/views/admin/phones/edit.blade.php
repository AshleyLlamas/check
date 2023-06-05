@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    <div class="py-4">
        @livewire('admin.phones.phones-edit', ['phone' => $phone], key($phone->id))
    </div>
    
@stop

@section('css')

@stop

@section('js')

@stop
