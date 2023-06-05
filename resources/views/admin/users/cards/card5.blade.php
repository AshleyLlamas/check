@if ($card == 1)
                                                <img width="100%" src="{{ asset('images/credenciales/magnamaq/card1.png') }}"/>
                                                <div class="eye-qr">
                                                    {{-- {!! QrCode::size(290)->generate(':)') !!} --}}
                                                </div>
                                                @isset($user->image)
                                                    <img class="octa" src="@isset($user->image) {{route('images', $user->image)}} @else https://cdn.pixabay.com/photo/2017/11/10/05/48/user-2935527_960_720.png @endisset"/>
                                                @endisset

                                                <p class="text-name">{{$user->name}}</p>
                                                <p class="text-puesto ">
                                                    {{$user->puesto}}</p>
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
                                                <img width="100%" src="{{ asset('images/credenciales/magnamaq/card2.png') }}"/>
                                                <div class="eye-qr">
                                                    {!! QrCode::size(345)->generate($this->user->qr) !!}
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
            width: 5.4cm;
            height: 5.4cm;
            top: 367px;
            z-index: 2;

            left: 164px;

            border-radius: 2%;
        }

        .octa {
            top: 355px;
            left: 152px;
            display: block;
            margin: 0 auto;
            position: absolute;
            width: 360px;
            height: 311.76px; /* width * 0.866 */
            box-sizing: border-box;
            -webkit-clip-path: polygon(0% 50%, 25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%);
            -moz-clip-path: polygon(0% 50%, 25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%);
        }


        .eye-qr{
            position:absolute;
            top: 375px;
            left : 155px;
            z-index: 1;
        }

        .text-name {
            position: absolute;
            top: 680px;
            text-align: center;
            font-size: 26px;
            font-weight: bold;

            width: 16.5cm;
        }

        .text-puesto{
            position: absolute;
            top: 720px;
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
            top: 855px;
            left: 180px;
            font-size: 20px;
            font-weight: bold;
        }

        .text-no{
            position: absolute;
            top: 780px;
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
            top: 800px;
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
