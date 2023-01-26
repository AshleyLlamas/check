@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content')
    <div class="py-4">
        @livewire('admin.admonitions.admonitions-show', ['admonition' => $admonition], key($admonition->id))
    </div>
@stop

@section('js')

@endsection

@section('css')
    
@endsection