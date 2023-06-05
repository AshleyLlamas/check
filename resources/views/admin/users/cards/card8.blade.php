@if ($card == 1)
    <img width="100%" src="{{ asset('images/credenciales/makro/card1.jpg') }}"/>
    <div class="eye-qr">
        {{-- {!! QrCode::size(290)->generate(':)') !!} --}}
    </div>
    @isset($user->image)
        <img class="eye-photo" src="@isset($user->image->url) {{route('images', $user->image)}} @else https://cdn.pixabay.com/photo/2017/11/10/05/48/user-2935527_960_720.png @endisset"/>
    @endisset

    <p class="text-name">
        @foreach (explode(" ", $user->name) as $item)
            {{$item}} <br>
        @endforeach
    </p>
    <p class="text-puesto">{{$user->puesto}}</p>
    <p class="text-no">{{$user->número_de_empleado}}</p>
    <p class="text-imss">{{$user->número_de_inscripción_al_imss}}</p>
    <p class="text-ingreso">
        @isset($user->fecha_de_ingreso)
            {{$user->fecha_de_ingreso->format('d-m-Y')}}
        @else
            N/A
        @endisset
    </p>
@endif
@if ($card == 2)
    <img width="100%" src="{{ asset('images/credenciales/makro/card2.jpg') }}"/>
    <div class="eye-qr">
        {!! QrCode::size(547)->generate($this->user->qr) !!}
    </div>
    @if ($user->areas->count())
        <p class="text-area">{{$user->areas->first()->área}}</p>
        @if ($user->areas->first()->encargado($user->areas->first()->pivot->encargado_id))
            <p class="text-puesto-encargado">{{$user->areas->first()->encargado($user->areas->first()->pivot->encargado_id)->puesto}}</p>
        @endif
        @if ($user->areas->first()->encargado($user->areas->first()->pivot->encargado_id))
            <p class="text-encargado">{{$user->areas->first()->encargado($user->areas->first()->pivot->encargado_id)->name}}</p>
        @endif
    @endif
@endif

@push('css')

    <style>

        .container-photo{
            width: 16.5cm;
        }

        .eye-photo{
            position:absolute;
            width: 8.3cm;
            height: 10.5cm;
            top: 266px;
            z-index: 2;

            left: 46px;

            border-radius: 2%;
        }

        .eye-qr{
            position:absolute;
            top: 127px;
            left : 60px;
            z-index: 1;
        }

        .text-name {
            position: absolute;
            top: 450px;
            font-size: 30px;
            font-weight: bold;
            line-height: 0.9;
            left: 370px;

            color: #005095;
        }

        .text-puesto{
            position: absolute;
            top: 615px;
            left: 370px;
            font-size: 18px;
            width: 8cm;

            color: gray;
        }

        .text-imss{
            position: absolute;
            top: 805px;
            left: 50px;
            font-size: 20px;
            font-weight: bold;
        }

        .text-no{
            position: absolute;
            top: 740px;
            left: 50px;
            font-size: 26px;
            font-weight: bold;
        }

        .text-ingreso{
            position: absolute;
            top: 993px;
            left: 80px;
            font-size: 20px;
            font-weight: bold;
        }

        .text-area{
            position: absolute;
            top: 703px;
            left: 290px;
            font-size: 16px;
            font-weight: bold;
            width: 16.5cm;
        }

        .text-puesto-encargado{
            position: absolute;
            top: 727px;
            left: 290px;
            font-size: 20px;
            font-weight: bold;
            width: 16.5cm;
            color: #005095;
        }

        .text-encargado{
            position: absolute;
            top: 750px;
            left: 290px;
            font-size: 16px;
            font-weight: bold;
            width: 16.5cm;
        }

    </style>
@endpush
