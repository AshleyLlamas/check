<div>
    <div class="card border-0 rounded-0 shadow">
        <div class="card-body">
            <div class="text-start text-secondary">
                @isset($existe_un_check->in)
                    <p class="mb-1"><i class="fa-solid fa-clock"></i> <b>Entrada:</b> {{$existe_un_check->in->hora->format('h:i:s A')}}</p>
                @endisset
                @isset($existe_un_check->out)
                    <p class="mb-1"><i class="fa-solid fa-clock"></i> <b>Salida:</b> {{$existe_un_check->out->hora->format('h:i:s A')}}</p>
                @endisset
            </div>
            @isset($user)
                <div class="text-center">
                    <img draggable="false" width="300px" class="rounded-circle shadow"
                    src="@if($user->image) {{Storage::url($user->image->url)}} @else {{asset('recursos/foto-default.png')}} @endif"
                    alt="Fotografía">
                    <div class="pt-4">
                        @isset($user->número_de_empleado)
                            <h5>#{{$user->número_de_empleado}}</h5>
                        @endisset
                        <h2><b>{{$user->name}}</b></h2>
                    </div>
                </div>
                <div class="text-center pb-3">
                    @if (!isset($existe_un_check->in) || !isset($existe_un_check->out))
                        <div>
                            <button class="btn btn-secondary" wire:loading.attr="disabled" wire:click.prevent.debounce.500ms="save()" wire:target="save">@isset($existe_un_check->in) Check out  @else Check in @endisset</button>
                        </div>
                        <div wire:loading wire:target="save" class="pt-4">
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border" role="status">
                                  <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="row g-0">
                    <div class="card-body p-4">
                        <h6 class="text-center">INGRESE SUS CREDENCIALES</h6>
                        <hr class="mt-0 mb-4">
                        @if (session()->has('error'))
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <div>
                                    <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="emai" class="form-control @error('número_de_empleado') is-invalid @enderror" wire:model.defer="número_de_empleado">
                                    <label for="número_de_empleado" class="col-md-4 col-form-label">{{ __('Número de empleado') }}</label>
                                    @error('número_de_empleado')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0 mb-4">
                        <div class="mb-0 text-center">
                            <button type="button" class="btn btn-primary" wire:click.prevent="search">
                                {{ __('Buscar') }}
                            </button>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </div>
</div>

@push('css')
    <style>
        .button-check{
            width:200px;
            height:70px;
            background: linear-gradient(to left top, #045697 50%, #226B97  50%);
            border-style: none;
            color:#fff;
            font-size: 23px;
            font-weight: 600;
            outline: none;
            cursor: pointer;
            position: relative;
            padding: 0px;
            overflow: hidden;
            transition: all .5s;
            box-shadow: 0px 1px 2px rgba(0,0,0,.2);
        }

        .button-check span{
            position: absolute;
            display: block;
        }

        .button-check span:nth-child(1){
            height: 3px;
            width:200px;
            top:0px;
            left:-200px;
            background: linear-gradient(to right, rgba(0,0,0,0), #f6e58d);
            border-top-right-radius: 1px;
            border-bottom-right-radius: 1px;
            animation: span1 2s linear infinite;
            animation-delay: 1s;
        }

        @keyframes span1{
            0%{
                left:-200px
            }
            100%{
                left:200px;
            }
        }

        .button-check span:nth-child(2){
            height: 70px;
            width: 3px;
            top:-70px;
            right:0px;
            background: linear-gradient(to bottom, rgba(0,0,0,0), #f6e58d);
            border-bottom-left-radius: 1px;
            border-bottom-right-radius: 1px;
            animation: span2 2s linear infinite;
            animation-delay: 2s;
        }

        @keyframes span2{
            0%{
                top:-70px;
            }
            100%{
                top:70px;
            }
        }

        .button-check span:nth-child(3){
            height:3px;
            width:200px;
            right:-200px;
            bottom: 0px;
            background: linear-gradient(to left, rgba(0,0,0,0), #f6e58d);
            border-top-left-radius: 1px;
            border-bottom-left-radius: 1px;
            animation: span3 2s linear infinite;
            animation-delay: 3s;
        }

        @keyframes span3{
            0%{
                right:-200px;
            }
            100%{
                right: 200px;
            }
        }

        .button-check span:nth-child(4){
            height:70px;
            width:3px;
            bottom:-70px;
            left:0px;
            background: linear-gradient(to top, rgba(0,0,0,0), #f6e58d);
            border-top-right-radius: 1px;
            border-top-left-radius: 1px;
            animation: span4 2s linear infinite;
            animation-delay: 4s;
        }
        @keyframes span4{
            0%{
                bottom: -70px;
            }
            100%{
                bottom:70px;
            }
        }

        .button-check:hover{
            transition: all .5s;
            transform: rotate(-3deg) scale(1.1);
            box-shadow: 0px 3px 5px rgba(0,0,0,.4);
        }

        .button-check:hover span{
            animation-play-state: paused;
        }

        /*  footer   */
        footer {
            background-color: #222;
            color: #fff;
            font-size: 14px;
            bottom: 0;
            position: fixed;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 999;
        }

        footer p {
            margin: 10px 0;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida  Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }
        footer .fa-heart{
            color: red;
        }
        footer .fa-dev{
            color: #fff;
        }
        footer .fa-twitter-square{
        color:#1da0f1;
        }
        footer .fa-instagram{
        color: #f0007c;
        }
        fotter .fa-linkedin{
        color:#0073b1;
        }
        footer .fa-codepen{
        color:#fff
        }
        footer a {
            color: #3c97bf;
            text-decoration: none;
        margin-right:5px;
        }
        .youtubeBtn{
            position: fixed;
            left: 50%;
            transform:translatex(-50%);
            bottom: 45px;
            cursor: pointer;
            transition: all .3s;
            vertical-align: middle;
            text-align: center;
            display: inline-block;
        }
        .youtubeBtn i{
        font-size:20px;
        float:left;
        }
        .youtubeBtn a{
            color:#ff0000;
            text-shadow: 0px 2px 5px rgba(0,0,0,.5);
            animation: youtubeAnim 1000ms linear infinite;
        float:right;
        }
        .youtubeBtn a:hover{
        color:#c9110f;
        transition:all .3s ease-in-out;
        text-shadow: none;
        }
        .youtubeBtn i:active{
        transform:scale(.9);
        transition:all .3s ease-in-out;
        }
        .youtubeBtn span{
            font-family: 'Lato';
            font-weight: bold;
            color: #fff;
            display: block;
            font-size: 12px;
            float: right;
            line-height: 20px;
            padding-left: 5px;

        }

        @keyframes youtubeAnim{
        0%,100%{
            color:#c9110f;
        }
        50%{
            color:#ff0000;
        }
        }
        /* footer  */
    </style>
@endpush
