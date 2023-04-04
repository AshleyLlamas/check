@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    @livewire('admin.administrative-records.administrative-records-edit', ['administrative_record' => $administrative_record], key($administrative_record->id))
@stop

@section('css')

@stop

@section('js')

@stop
