@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content')
   <div class="py-4">
        @livewire('admin.extra-hours.extra-hours-show', ['extraHour' => $extraHour], key($extraHour->id))
   </div>
@stop
