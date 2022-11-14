@extends('layouts.app')

{{-- @section('css')
    <style>
        img{
            -moz-user-select: none;
        }
    </style>
@endsection --}}

@section('content')
    <div class="py-4">
        <div class="container">
            {{-- <p id="time"></p> --}}
            @livewire('check.check-create', ['user' => Auth::user()], key(Auth::user()->id))
        </div>
    </div>
@endsection

@section('js')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
    
        var timestamp = '{{--=time();';

        function updateTime(){
        $('#time').html(
                Date(timestamp)
            );
            
            timestamp++;

            ///
            // var date = new Date(timestamp * 1000);
            // var hours = date.getHours();
            // var minutes = "0" + date.getMinutes();
            // var seconds = "0" + date.getSeconds();

            // var formattedTime = hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);

            // console.log(formattedTime);
        }

        $(function(){
            setInterval(updateTime, 1000);
        });
    </script> --}}
@endsection