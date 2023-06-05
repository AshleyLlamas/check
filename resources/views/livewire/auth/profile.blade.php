<div>
    <div class="card border-0 rounded-0 shadow mb-3">
        <div class="row g-0">
            <div class="col-md-4 gradient-custom text-center text-white p-5">
                <img draggable="false" class="img-fluid rounded-circle shadow" src="@if($user->image) {{route('images', $user->image)}} @else {{asset('recursos/foto-default.png')}} @endif"/>
                <h5 class="pt-5">{{$user->name}}</h5>
                <p>#{{$user->número_de_empleado}}</p>
            </div>
            <div class="col-md-8">
                <div class="card-body text-center p-4">
                    <h6>Información</h6>
                    <hr class="mt-0 mb-4">
                    <div class="row pt-1">
                        <div class="col mb-3">
                            <h6>Correo electrónico</h6>
                            <p class="text-muted">
                                @isset($user->email)
                                    {{$user->email}}
                                @else
                                    N/A
                                @endisset
                            </p>
                        </div>
                        <div class="col mb-3">
                            <h6>Compañia / Empresa</h6>
                            <p class="text-muted">
                                @isset($user->company)
                                    {{$user->company->nombre_de_la_compañia}}
                                @else
                                    N/A
                                @endisset
                            </p>
                        </div>
                        <div class="col mb-3">
                            <h6>Número de empleado</h6>
                            <p class="text-muted">
                                @isset($user->número_de_empleado)
                                    {{$user->número_de_empleado}}
                                @else
                                    N/A
                                @endisset
                            </p>
                        </div>
                        <div class="col mb-3">
                            <h6>Puesto</h6>
                            <p class="text-muted">
                                @isset($user->puesto)
                                    {{$user->puesto}}
                                @else
                                    N/A
                                @endisset
                            </p>
                        </div>
                    </div>
                    <h6>Horario</h6>
                    <hr class="mt-0 mb-4">
                    <div class="pt-1">
                        <div class="table-responsive">
                            @if($user->schedules->count())
                                <table class="table text-center border">
                                    <thead>
                                        <tr>
                                            <th><i class="fa-solid fa-clock"></i></th>
                                            @foreach ($user->schedules as $schedule)
                                                <th class="border-start">{{$schedule->día}}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">Entrada</th>
                                        @foreach ($user->schedules as $n => $schedule)
                                            <td class="border-start">
                                                {{$schedule->hora_de_entrada->format('h:i a')}}
                                            </td>
                                        @endforeach
                                    </tr>
                                        <tr>
                                            <th scope="row">Salida</th>
                                            @foreach ($user->schedules as $n => $schedule)
                                                <td class="border-start">
                                                    {{$schedule->hora_de_salida->format('h:i a')}}
                                                </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <p class="text-danger text-center mb-1"><b>Sin horario.</b></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-0 rounded-0 shadow mb-3">
        <div class="row g-0">
            <div>
                <div class="card-body text-center p-4">
                    <h6>Checks</h6>
                    <hr class="mt-0 mb-4">
                    <div class="pt-1">
                        <div class="table-responsive">
                            @if($user->checks->count())
                                <table class="table table-striped table-hover text-center border">
                                    <thead>
                                        <tr>
                                            <th scope="col"><h5 class="mb-1 pt-1">Fecha</h5></th>
                                            <th scope="col"><h5 class="mb-1 pt-1">Entrada</h5></th>
                                            <th scope="col"><h5 class="mb-1 pt-1">Salida</h5></th>
                                            <th scope="col"><h5 class="mb-1 pt-1">Asistencia</h5></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($checks as $check)
                                            <tr>
                                                <th>
                                                    {{$check->fecha->format('d-m-Y')}}
                                                </th>
                                                <th>
                                                    @isset($check->in)
                                                        {{$check->in->hora->format('h:i:s A')}}
                                                    @else
                                                        N/A
                                                    @endisset
                                                </th>
                                                <th>
                                                    @isset($check->out)
                                                        {{$check->out->hora->format('h:i:s A')}}
                                                    @else
                                                        N/A
                                                    @endisset
                                                </th>
                                                <th>
                                                    @isset($check->assistance)
                                                        <i class="fa-solid fa-circle-check" style="color: green"></i> Asistió
                                                    @else
                                                        <i class="fa-solid fa-circle-xmark" style="color: gray"></i> Pendiente
                                                    @endisset
                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="px-3">{{$checks->links()}}</div>
                            @else
                                <p class="text-danger text-center mb-1"><b>Sin horario.</b></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @push('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.addEventListener('swal',function(e){
            Swal.fire(e.detail);
        });
    </script>
@endpush --}}
