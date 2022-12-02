@extends('layouts.app')

@section('content')
    <div class="py-4">
        <div class="container">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            {{-- @livewire('home') --}}
        </div>
    </div>
@endsection