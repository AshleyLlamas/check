@extends('adminlte::page')

@section('title', 'Intranet')

@section('content')
    <div class="py-4">
        @livewire('admin.areas.areas-show', ['area' => $area], key($area->id))
    </div>
@stop

@section('js')

@endsection

@section('css')

@endsection
