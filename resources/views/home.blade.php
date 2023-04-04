@extends('layouts.app')

@section('content')
    <div class="py-4">
        <div class="container">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            {{-- @isset($map)
               {{print_r($map)}}
            @endisset --}}
        </div>
    </div>
@endsection
