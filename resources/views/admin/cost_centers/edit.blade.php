@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content')
    @livewire('admin.cost-centers.cost-centers-edit', ['cost_center' => $cost_center], key($cost_center->id))
@stop

@section('css')
    
@stop

@section('js')
    
@stop