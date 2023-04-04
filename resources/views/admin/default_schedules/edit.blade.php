@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    @livewire('admin.default-shedules.default-schedule-edit', ['default_schedule' => $default_schedule], key($default_schedule->id))
@stop

@section('css')

@stop

@section('js')

@stop
