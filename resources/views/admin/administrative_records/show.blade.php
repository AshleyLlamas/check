@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content')
    <div class="py-4">
        @livewire('admin.administrative-records.administrative-records-show', ['administrative_record' => $administrative_record], key($administrative_record->id))
    </div>
@stop

@section('js')

@endsection

@section('css')
    
@endsection