@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
<div class="py-4">
    @livewire('admin.devices.devices-edit', ['device' => $device], key($device->id))
</div>
   
@stop

@section('css')

@stop

@section('js')

@stop
