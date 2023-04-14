@extends('layouts.app')

@section('css')

@endsection

@section('content')
    <div class="py-4">
        <div class="container">
            @livewire('device.check', ['device' => \Auth::guard('device')->user()], key(\Auth::guard('device')->user()->id))
        </div>
    </div>
@endsection

@section('js')

@endsection
