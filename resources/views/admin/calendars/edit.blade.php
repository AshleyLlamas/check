@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content')
   <div class="py-4">
        @livewire('admin.non-working-days.non-working-days-edit', ['nonWorkingDay' => $nonWorkingDay], key($nonWorkingDay->id))
   </div>
@stop
