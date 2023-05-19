@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    <div class="py-4">
        @livewire('admin.default-shedules.default-schedule-edit', ['default_schedule' => $default_schedule], key($default_schedule->id))
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
