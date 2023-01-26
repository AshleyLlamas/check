@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content')
    @livewire('administrative-records.administrative-records-edit', ['administrativeRecord' => $administrativeRecord], key($administrativeRecord->id))
@stop

@section('css')
    
@stop

@section('js')
    
@stop