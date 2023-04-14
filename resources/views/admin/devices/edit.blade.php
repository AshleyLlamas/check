@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    @livewire('admin.devices.devices-edit', ['device' => $device], key($device->id))
@stop

@section('css')

@stop

@section('js')

@stop
