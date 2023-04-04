@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    <div class="py-4">
        @livewire('admin.computers.computers-show', ['computer' => $computer], key($computer->id))
    </div>
@stop

@section('js')

@endsection

@section('css')

@endsection
