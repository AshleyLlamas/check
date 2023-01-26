@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content')
    <div class="py-4">
        @livewire('administrative-records.administrative-records-show', ['administrativeRecord' => $administrativeRecord], key($administrativeRecord->id))
    </div>
@stop

@section('js')

@endsection

@section('css')
    
@endsection