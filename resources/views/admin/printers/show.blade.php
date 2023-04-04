@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    <div class="py-4">
        @livewire('admin.printers.printers-show', ['printer' => $printer], key($printer->id))
    </div>
@stop

@section('js')

@endsection

@section('css')

@endsection
