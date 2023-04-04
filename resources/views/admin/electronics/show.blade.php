@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    <div class="py-4">
        @livewire('admin.electronics.electronics-show', ['electronic' => $electronic], key($electronic->id))
    </div>
@stop

@section('js')

@endsection

@section('css')

@endsection
