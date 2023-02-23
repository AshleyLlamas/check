@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content')
    <div class="py-4">
        @livewire('admin.inventories.inventories-show', ['inventory' => $inventory], key($inventory->id))
    </div>
@stop

@section('js')

@endsection

@section('css')

@endsection
