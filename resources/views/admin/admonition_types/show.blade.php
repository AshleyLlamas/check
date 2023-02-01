@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content')
    <div class="py-4">
        @livewire('admin.admonition-types.admonition-types-show', ['admonition_type' => $admonition_type], key($admonition_type->id))
    </div>
@stop

@section('js')

@endsection

@section('css')
    
@endsection