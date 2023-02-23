@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content')
   <div class="py-4">
        @livewire('admin.non-working-days.non-working-days-index')
   </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/locales-all.js"></script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.css">
@endsection
