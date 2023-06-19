@if ($card == 1)
                                                <img width="100%" src="{{ asset('images/credenciales/lubinort/card1.png') }}"/>
                                                <div class="eye-qr">
                                                    {{-- {!! QrCode::size(290)->generate(':)') !!} --}}
                                                </div>
                                                @isset($user->image)
                                                    <img class="eye-photo rounded" src="@isset($user->image) {{route('images', $user->image)}} @else https://cdn.pixabay.com/photo/2017/11/10/05/48/user-2935527_960_720.png @endisset"/>
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
                                                <img width="100%" src="{{ asset('images/credenciales/lubinort/card2.png') }}"/>
                                                <div class="eye-qr">
                                                    {!! QrCode::size(495)->generate($this->user->qr) !!}
                                                </div>
                                                @if ($user->areas->count())
                                                    <p class="text-area"><span class="text-warning">Área:</span> <br>{{$user->areas->first()->área}}</p>
                                                    @if ($user->areas->first()->encargado($user->areas->first()->pivot->encargado_id))
                                                        <p class="text-encargado"><span class="text-warning">Encargado:</span> <br>{{$user->areas->first()->encargado($user->areas->first()->pivot->encargado_id)->name}}</p>
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
            height: 8.4cm;
            top: 389px;
            z-index: 2;

            left: 202px;

            border-radius: 2%;
        }

        .eye-qr{
            position:absolute;
            top:310px;
            left : 91px;
            z-index: 1;
        }

        .text-name {
            position: absolute;
            top: 740px;
            text-align: center;
            font-size: 26px;
            font-weight: bold;

            width: 16.5cm;
        }

        .text-puesto{
            position: absolute;
            top: 775px;
            left: 180px;

            font-size: 20px;
            font-weight: bold;

            color: orange;

            width: 6cm;
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
            top: 900px;
            left: 180px;
            font-size: 20px;
            font-weight: bold;
        }

        .text-no{
            position: absolute;
            top: 835px;
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
            top: 840px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            width: 16.5cm;
        }

        .text-encargado{
            position: absolute;
            top: 885px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            width: 16.5cm;
        }

    </style>
@endpush
