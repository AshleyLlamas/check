@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    @livewire('admin.areas.areas-edit', ['area' => $area], key($area->id))
@stop

@section('css')

@stop

@section('js')

@stop
