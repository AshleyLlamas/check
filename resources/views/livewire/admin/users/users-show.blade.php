<div>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @can('admin.users.index')
                <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">Todos los empleados</a></li>
            @endcan
            <li class="breadcrumb-item active">Ver empleado</li>
        </ol>
    </nav>
    <!-- Main content -->
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="@if($user->image) {{Storage::url($user->image->url)}} @else {{asset('recursos/foto-default.png')}} @endif"
                            alt="Fotografía">
                        </div>

                        <h3 class="profile-username text-center">{{$user->name}}</h3>

                        <p class="text-muted text-center">{{$user->puesto}}</p>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- Yo -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa-solid fa-user"></i> Información</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                                <strong>Nombre</strong>

                                <p class="text-muted">
                                    @isset($user->name)
                                        {{$user->name}}
                                    @else
                                        N/A
                                    @endisset
                                </p>
                            <hr>
                                <strong>Correo</strong>

                                <p class="text-muted">
                                    @isset($user->email)
                                        {{$user->email}}
                                    @else
                                        N/A
                                    @endisset
                                </p>
                            <hr>
                                <strong>CURP</strong>

                                <p class="text-muted">
                                    @isset($user->curp)
                                        {{$user->curp}}
                                    @else
                                        N/A
                                    @endisset
                                </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- Empleo -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa-solid fa-envelope"></i> Empleo</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                                <strong>Número del empleado</strong>

                                <p class="text-muted">
                                    @isset($user->número_de_empleado)
                                        {{$user->número_de_empleado}}
                                    @else
                                        N/A
                                    @endisset
                                </p>
                            <hr>
                                <strong>Puesto</strong>

                                <p class="text-muted">
                                    @isset($user->puesto)
                                        {{$user->puesto}}
                                    @else
                                        N/A
                                    @endisset
                                </p>
                            <hr>
                                <strong>Compañia / Empresa</strong>

                                <p class="text-muted">
                                    @isset($user->company->nombre_de_la_compañia)
                                        {{$user->company->nombre_de_la_compañia}}
                                    @else
                                        N/A
                                    @endisset
                                </p>
                            <hr>
                                <strong>Tipo de empleado</strong>

                                <p class="text-muted">
                                    @isset($user->tipo_de_empleado)
                                        {{$user->tipo_de_empleado}}
                                    @else
                                        N/A
                                    @endisset
                                </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- Documentos -->
                    @isset($user->document)
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa-solid fa-folder"></i> Documentos</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-lg-6 pt-2">
                                        <button type="button" class="h-100 btn @isset($user->document->documento_de_identificación_oficial) btn-secondary @else btn-outline-secondary @endisset btn-block" data-toggle="modal" data-target="#identificaciónOficial">Identificación oficial / INE</button>
                                    </div>
                                    <div class="col-12 col-lg-6 pt-2">
                                        <button type="button" class="h-100 btn @isset($user->document->documento_del_comprobante_de_domicilio) btn-secondary @else btn-outline-secondary @endisset btn-block" data-toggle="modal" data-target="#comprobanteDeDomicilio">Comprobante de domicilio</button>
                                    </div>
                                    <div class="col-12 col-lg-6 pt-2">
                                        <button type="button" class="h-100 btn @isset($user->document->documento_de_no_antecedentes_penales) btn-secondary @else btn-outline-secondary @endisset btn-block" data-toggle="modal" data-target="#noAtecedentesPenales">No atecendentes penales</button>
                                    </div>
                                    <div class="col-12 col-lg-6 pt-2">
                                        <button type="button" class="h-100 btn @isset($user->document->documento_de_la_licencia_de_conducir) btn-secondary @else btn-outline-secondary @endisset btn-block" data-toggle="modal" data-target="#licenciaDeConducir">Licencia de conducir</button>
                                    </div>
                                    <div class="col-12 col-lg-6 pt-2">
                                        <button type="button" class="h-100 btn @isset($user->document->documento_de_la_cedula_profesional) btn-secondary @else btn-outline-secondary @endisset btn-block" data-toggle="modal" data-target="#cédulaProfesional">Cédula profesional</button>
                                    </div>
                                    <div class="col-12 col-lg-6 pt-2">
                                        <button type="button" class="h-100 btn @isset($user->document->documento_de_la_carta_de_pasante) btn-secondary @else btn-outline-secondary @endisset btn-block" data-toggle="modal" data-target="#cartaDePasante">Carta de pasante</button>
                                    </div>
                                    <div class="col-12 col-lg-6 pt-2">
                                        <button type="button" class="h-100 btn @isset($user->document->documento_del_curriculum_vitae) btn-secondary @else btn-outline-secondary @endisset btn-block" data-toggle="modal" data-target="#curriculumVitae">Curriculum Vitae</button>
                                    </div>
                                </div>
                                <!-- Modal identificación -->
                                <div class="modal fade" id="identificaciónOficial" tabindex="-1" aria-labelledby="identificaciónOficialLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header bg-secondary">
                                                <h5 class="modal-title" id="identificaciónOficialLabel">Identificación oficial</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div>
                                                    @if($user->document->documento_de_identificación_oficial)
                                                        @php
                                                            $extension = pathinfo($user->document->documento_de_identificación_oficial)['extension'];
                                                        @endphp
                                                        @if($extension =="jpg" || $extension == "jpeg" || $extension == "png")
                                                            <div class="pt-3">
                                                                <img style="display: block; margin-left: auto; margin-right: auto;"  class="img-fluid" src="{{Storage::url($user->document->documento_de_identificación_oficial)}}">
                                                            </div>
                                                        @else
                                                            <iframe width="100%" height="500px" src="{{Storage::url($user->document->documento_de_identificación_oficial)}}" frameborder="0"></iframe>
                                                        @endif
                                                    @else
                                                        <p class="text-danger text-center mb-1"><strong>No se encontró ningún archivo</strong></p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal comprobante de domicilio -->
                                <div class="modal fade" id="comprobanteDeDomicilio" tabindex="-1" aria-labelledby="comprobanteDeDomicilioLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header bg-secondary">
                                                <h5 class="modal-title" id="comprobanteDeDomicilioLabel">Comprobante de domicilio</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div>
                                                    @if($user->document->documento_del_comprobante_de_domicilio)
                                                        @php
                                                            $extension = pathinfo($user->document->documento_del_comprobante_de_domicilio)['extension'];
                                                        @endphp
                                                        @if($extension =="jpg" || $extension == "jpeg" || $extension == "png")
                                                            <div class="pt-3">
                                                                <img style="display: block; margin-left: auto; margin-right: auto;"  class="img-fluid" src="{{Storage::url($user->document->documento_del_comprobante_de_domicilio)}}">
                                                            </div>
                                                        @else
                                                            <iframe width="100%" height="500px" src="{{Storage::url($user->document->documento_del_comprobante_de_domicilio)}}" frameborder="0"></iframe>
                                                        @endif
                                                    @else
                                                        <p class="text-danger text-center mb-1"><strong>No se encontró ningún archivo</strong></p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal no atecendentes penales -->
                                <div class="modal fade" id="noAtecedentesPenales" tabindex="-1" aria-labelledby="noAtecedentesPenalesLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header bg-secondary">
                                                <h5 class="modal-title" id="noAtecedentesPenalesLabel">No atecendentes penales</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div>
                                                    @if($user->document->documento_de_no_antecedentes_penales)
                                                        @php
                                                            $extension = pathinfo($user->document->documento_de_no_antecedentes_penales)['extension'];
                                                        @endphp
                                                        @if($extension =="jpg" || $extension == "jpeg" || $extension == "png")
                                                            <div class="pt-3">
                                                                <img style="display: block; margin-left: auto; margin-right: auto;"  class="img-fluid" src="{{Storage::url($user->document->documento_de_no_antecedentes_penales)}}">
                                                            </div>
                                                        @else
                                                            <iframe width="100%" height="500px" src="{{Storage::url($user->document->documento_de_no_antecedentes_penales)}}" frameborder="0"></iframe>
                                                        @endif
                                                    @else
                                                        <p class="text-danger text-center mb-1"><strong>No se encontró ningún archivo</strong></p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal licencia de conducir -->
                                <div class="modal fade" id="licenciaDeConducir" tabindex="-1" aria-labelledby="licenciaDeConducirLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header bg-secondary">
                                                <h5 class="modal-title" id="licenciaDeConducirLabel">Licencia de conducir</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div>
                                                    @if($user->document->documento_de_la_licencia_de_conducir)
                                                        @php
                                                            $extension = pathinfo($user->document->documento_de_la_licencia_de_conducir)['extension'];
                                                        @endphp
                                                        @if($extension =="jpg" || $extension == "jpeg" || $extension == "png")
                                                            <div class="pt-3">
                                                                <img style="display: block; margin-left: auto; margin-right: auto;"  class="img-fluid" src="{{Storage::url($user->document->documento_de_la_licencia_de_conducir)}}">
                                                            </div>
                                                        @else
                                                            <iframe width="100%" height="500px" src="{{Storage::url($user->document->documento_de_la_licencia_de_conducir)}}" frameborder="0"></iframe>
                                                        @endif
                                                    @else
                                                        <p class="text-danger text-center mb-1"><strong>No se encontró ningún archivo</strong></p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal cédula profesional -->
                                <div class="modal fade" id="cédulaProfesional" tabindex="-1" aria-labelledby="cédulaProfesionalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header bg-secondary">
                                                <h5 class="modal-title" id="cédulaProfesionalLabel">Cedula profesional</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div>
                                                    @if($user->document->documento_de_la_cedula_profesional)
                                                        @php
                                                            $extension = pathinfo($user->document->documento_de_la_cedula_profesional)['extension'];
                                                        @endphp
                                                        @if($extension =="jpg" || $extension == "jpeg" || $extension == "png")
                                                            <div class="pt-3">
                                                                <img style="display: block; margin-left: auto; margin-right: auto;"  class="img-fluid" src="{{Storage::url($user->document->documento_de_la_cedula_profesional)}}">
                                                            </div>
                                                        @else
                                                            <iframe width="100%" height="500px" src="{{Storage::url($user->document->documento_de_la_cedula_profesional)}}" frameborder="0"></iframe>
                                                        @endif
                                                    @else
                                                        <p class="text-danger text-center mb-1"><strong>No se encontró ningún archivo</strong></p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal carta de pasante -->
                                <div class="modal fade" id="cartaDePasante" tabindex="-1" aria-labelledby="cartaDePasanteLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header bg-secondary">
                                                <h5 class="modal-title" id="cartaDePasanteLabel">Carta de pasante</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div>
                                                    @if($user->document->documento_de_la_carta_de_pasante)
                                                        @php
                                                            $extension = pathinfo($user->document->documento_de_la_carta_de_pasante)['extension'];
                                                        @endphp
                                                        @if($extension =="jpg" || $extension == "jpeg" || $extension == "png")
                                                            <div class="pt-3">
                                                                <img style="display: block; margin-left: auto; margin-right: auto;"  class="img-fluid" src="{{Storage::url($user->document->documento_de_la_carta_de_pasante)}}">
                                                            </div>
                                                        @else
                                                            <iframe width="100%" height="500px" src="{{Storage::url($user->document->documento_de_la_carta_de_pasante)}}" frameborder="0"></iframe>
                                                        @endif
                                                    @else
                                                        <p class="text-danger text-center mb-1"><strong>No se encontró ningún archivo</strong></p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="curriculumVitae" tabindex="-1" aria-labelledby="curriculumVitaeLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header bg-secondary">
                                                <h5 class="modal-title" id="curriculumVitaeLabel">Curriculum vitae</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div>
                                                    @if($user->document->documento_del_curriculum_vitae)
                                                        @php
                                                            $extension = pathinfo($user->document->documento_del_curriculum_vitae)['extension'];
                                                        @endphp
                                                        @if($extension =="jpg" || $extension == "jpeg" || $extension == "png")
                                                            <div class="pt-3">
                                                                <img style="display: block; margin-left: auto; margin-right: auto;"  class="img-fluid" src="{{Storage::url($user->document->documento_del_curriculum_vitae)}}">
                                                            </div>
                                                        @else
                                                            <iframe width="100%" height="500px" src="{{Storage::url($user->document->documento_del_curriculum_vitae)}}" frameborder="0"></iframe>
                                                        @endif
                                                    @else
                                                        <p class="text-danger text-center mb-1"><strong>No se encontró ningún archivo</strong></p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    @endisset
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="row">
                        <div class="col">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fa-regular fa-calendar-xmark"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Faltas</span>
                                    <span class="info-box-number">{{$faltas}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-solid fa-business-time"></i></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Retardos</span>
                                    <span class="info-box-number">{{$retardos}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-triangle-exclamation"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Accidentes</span>
                                    <span class="info-box-number">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Horario -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title pt-1">Horario</h3>
                            <button type="button" class="btn btn-sm btn-default float-right"><i class="fa-solid fa-pen-to-square"></i></button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div>
                                <div class="table-responsive">
                                    @if($user->schedules->count())
                                        <table class="table text-center border">
                                            <thead class="text-primary">
                                                <tr>
                                                    <th><i class="fa-solid fa-clock"></i></th>
                                                    @foreach ($user->schedules as $schedule)
                                                        <th class="border-left">{{$schedule->día}}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row" class="text-primary">Entrada</th>
                                                @foreach ($user->schedules as $n => $schedule)
                                                    <td class="border-left">
                                                        {{$schedule->hora_de_entrada->format('h:i a')}}
                                                    </td>
                                                @endforeach
                                            </tr>
                                                <tr>
                                                    <th scope="row" class="text-primary">Salida</th>
                                                    @foreach ($user->schedules as $n => $schedule)
                                                        <td class="border-left">
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
                        <!-- /.card-body -->
                    </div>
                    <!-- Asistencia -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Asistencia</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div>
                                <div id='calendar' wire:ignore></div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- Check -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Checks</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body text-center m-0 p-0">
                            <div>
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
                                                @foreach ($user->checks as $check)
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
                                    @else
                                        <p class="text-danger text-center mb-1"><b>Sin horario.</b></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@push('js')
    {{--<script src="{{ asset('js/calendar.js') }}"></script>--}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
        },
            initialDate: {!! json_encode($hoy) !!},
            navLinks: true, // can click day/week names to navigate views
            editable: false,
            selectable: false,
            dayMaxEvents: false, // allow "more" link when too many events
            events: {!! json_encode($json_dias) !!}
        });
        calendar.render();
        });
    </script>
@endpush