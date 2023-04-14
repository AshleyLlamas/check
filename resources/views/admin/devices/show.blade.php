@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    <div class="py-4">
        @livewire('admin.devices.devices-show', ['device' => $device], key($device->id))
    </div>
@stop

@section('js')

@endsection

@section('css')

@endsection
