@extends('layouts.app')

@section('content')
    <section>
        <div class="container py-4 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                @livewire('auth.profile', ['user' => Auth::user()], key(Auth::user()->id))
            </div>
        </div>
    </section>
@endsection
