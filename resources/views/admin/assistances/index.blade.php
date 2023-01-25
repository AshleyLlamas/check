@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content')
    <div class="py-4">
        @livewire('admin.assistances.assistances-index')
    </div>
@stop

@section('css')
    
@endsection