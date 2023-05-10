@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    <div class="py-4">
        @livewire('admin.safeties.safeties-show', ['safety' => $safety], key($safety->id))
    </div>
@stop

@section('js')

@endsection

@section('css')

@endsection
