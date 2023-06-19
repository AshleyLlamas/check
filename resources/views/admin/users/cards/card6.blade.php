@if ($card == 1)
                                                <img width="100%" src="{{ asset('images/credenciales/sle/card1.png') }}"/>
                                                <div class="eye-qr">
                                                    {{-- {!! QrCode::size(290)->generate(':)') !!} --}}
                                                </div>
                                                @isset($user->image)
                                                    <img class="eye-photo rounded-circle" src="@isset($user->image) {{route('images', $user->image)}} @else https://cdn.pixabay.com/photo/2017/11/10/05/48/user-2935527_960_720.png @endisset"/>
                                                @endisset

                                                <p class="text-name">{{$user->name}}</p>
                                                <p class="text-puesto ">{{$user->puesto}}</p>
                                                <p class="text-no">No. de empleado: <br>{{$user->número_de_empleado}}</p>
                                               @isset($user->número_de_inscripción_al_imss)
                                               <p class="text-imss">NSS: <br>{{$user->número_de_inscripción_al_imss}}</p>
                                               @endisset
                                                <p class="text-ingreso">
                                                    Ingreso: 
                                                    @isset($user->fecha_de_ingreso)
                                                        {{$user->fecha_de_ingreso->format('d-m-Y')}}
                                                    @else
                                                        N/A
                                                    @endisset
                                                </p>
                                            @endif
                                            @if ($card == 2)
                                                <img width="100%" src="{{ asset('images/credenciales/sle/card2.png') }}"/>
                                                <div class="eye-qr">
                                                    {!! QrCode::size(365)->generate($this->user->qr) !!}
                                                </div>
                                                @if ($user->areas->count())
                                                    <p class="text-area">Área: <br>{{$user->areas->first()->área}}</p>
                                                    @if ($user->areas->first()->encargado($user->areas->first()->pivot->encargado_id))
                                                        <p class="text-encargado">Encargado: <br>{{$user->areas->first()->encargado($user->areas->first()->pivot->encargado_id)->name}}</p>
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
            width: 7.4cm;
            height: 7.4cm;
            top: 268px;
            z-index: 2;

            left: 192px;

            border-radius: 2%;
        }

        .eye-qr{
            position:absolute;
            top: 173px;
            left : 147px;
            z-index: 1;
        }

        .text-name {
            position: absolute;
            top: 630px;
            text-align: center;
            font-size: 26px;
            font-weight: bold;

            width: 16.5cm;
        }

        .text-puesto{
            position: absolute;
            top: 660px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;

            color: orange;

            width: 16.5cm;
        }

        .text-curp {
            position: absolute;
            top: 710px;
            left: 164px;
            font-size: 20px;
            font-weight: bold;
        }

        .text-imss{
            position: absolute;
            top: 815px;
            left: 180px;
            font-size: 20px;
            font-weight: bold;
        }

        .text-no{
            position: absolute;
            top: 720px;
            left: 180px;
            font-size: 20px;
            font-weight: bold;
        }

        .text-ingreso{
            position: absolute;
            top: 1008px;
            left: 240px;
            font-size: 20px;
            font-weight: bold;
        }

        .text-area{
            
            position: absolute;
            top: 720px;
            left: 180px;
            font-size: 20px;
            font-weight: bold;
            width: 6cm;
        }

        .text-encargado{
            position: absolute;
            top: 815px;
            left: 180px;
            font-size: 20px;
            font-weight: bold;
            width: 6cm;
        }

    </style>
@endpush
