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

                            @isset($user->puesto)
                                <p class="text-muted text-center mb-0 pb-0">{{$user->puesto}}</p>
                            @endisset
                            @isset($user->tipo_de_puesto)
                                <p class="text-muted text-center mb-1"><small>({{$user->tipo_de_puesto}})</small></p>
                            @endisset

                            <span class="badge badge-pill badge-secondary">{{$user->estatus}}</span>
                        </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    @isset($user->qr)
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa-solid fa-qrcode"></i> Código QR de acceso</h3>
                            </div>
                            <div class="card-body ">
                                
                                    <div class="text-center pb-2">
                                        {!! QrCode::size(160)->generate('https://constructoramakro.mx/login/?'.$user->qr); !!}
                                        <a href="{{'https://constructoramakro.mx/login/?'.$user->qr}}">{{'https://constructoramakro.mx/login/?'.$user->qr}}</a>
                                    </div>
                                
                            </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    @endisset
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
                            <hr>
                                <strong>Fecha de nacimiento</strong>

                                <p class="text-muted">
                                    @isset($user->fecha_de_nacimiento)
                                        {{$user->fecha_de_nacimiento}}
                                    @else
                                        N/A
                                    @endisset
                                </p>
                            <hr>
                                <strong>Whatsapp</strong>

                                <p class="text-muted">
                                    @isset($user->whatsapp)
                                        <a href="https://api.whatsapp.com/send?phone={{$user->whatsapp}}">+{{$user->whatsapp}}</a>
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
                                <strong>Fecha de ingreso</strong>

                                <p class="text-muted">
                                    @isset($user->fecha_de_ingreso)
                                        {{$user->fecha_de_ingreso}}
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
                            <strong>Tipo de puesto</strong>

                                <p class="text-muted">
                                    @isset($user->tipo_de_puesto)
                                        {{$user->tipo_de_puesto}}
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
                                <strong>Centro de costo</strong>

                                <p class="text-muted">
                                    @isset($user->cost_center->folio)
                                        {{$user->cost_center->folio}}
                                    @else
                                        N/A
                                    @endisset
                                </p>
                            <hr>
                                <strong>Estatus</strong>

                                <p class="text-muted">
                                    @isset($user->tipo)
                                        {{$user->tipo}}
                                    @else
                                        N/A
                                    @endisset
                                </p>
                            @if($user->areas->count())
                            <hr>
                                <strong>
                                    Área
                                </strong>

                                @foreach ($user->areas as $area)
                                    <p class="text-muted">
                                        @isset($area->área)
                                            {{$area->área}}
                                        @else
                                            N/A
                                        @endisset
                                    </p>
                                <br>
                                @endforeach
                            @endif
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
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div>
                                @if (session()->has('message'))
                                    <div class="alert alert-success text-center"><i class="fa-solid fa-circle-check"></i> {{ session('message') }}</div>
                                @endif
                                @if (session()->has('error'))
                                    <div class="alert alert-danger text-center"><i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}</div>
                                @endif
                                <div class="table-responsive">
                                    @if($schedules->count())
                                        <table class="table table-bordered">
                                            <thead class="text-primary text-center">
                                                <tr>
                                                    <th scope="col">Día</th>
                                                    <th scope="col">Entrada</th>
                                                    <th scope="col">Salida</th>
                                                    @can('admin.users.edit')
                                                        <th></th>
                                                        <th></th>
                                                    @endcan
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($schedules as $n => $schedule)
                                                    <tr>
                                                        <td scope="row" class="text-center">
                                                            {{$schedule->día}}
                                                        </td>
                                                        <td class="text-center">
                                                            {{$schedule->hora_de_entrada->format('h:i a')}}
                                                        </td>
                                                        <td class="text-center">
                                                            {{$schedule->hora_de_salida->format('h:i a')}}
                                                        </td>
                                                        @can('admin.users.edit')
                                                            <td width="10px">
                                                                <button class="btn btn-sm btn-default" wire:click="editSchedule({{ $schedule->id }})"><i class="fas fa-edit"></i></button>
                                                            </td>
                                                            <td width="10px">
                                                                <form action="{{ route('admin.schedules.destroy', $schedule) }}" method="POST" class="alert-delete">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="delete()"><i class="fas fa-trash-alt"></i></button>
                                                                </form>
                                                            </td>
                                                        @endcan
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p class="text-danger text-center mb-1"><b>Sin horario.</b></p>
                                    @endif
                                </div>
                                <div>
                                    @can('admin.users.edit')
                                        <button class="btn btn-sm btn-success" style="float: right;" data-toggle="modal" data-target="#createScheduleModal"><i class="fa-solid fa-plus"></i> Agregar día</button>
                                    @endcan

                                    <!-- Modal create -->
                                    <div wire:ignore.self class="modal fade" id="createScheduleModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title">Agregar día al horario</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <form wire:submit.prevent="createSchedule">
                                                        <div class="form-group">
                                                            <div>
                                                                <label class="col-form-label">
                                                                    {{ __('Día') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <select class="form-control" id="día" wire:model="día">
                                                                    <option value="">Selecciona una opción</option>
                                                                    <option>Lunes</option>
                                                                    <option>Martes</option>
                                                                    <option>Miércoles</option>
                                                                    <option>Jueves</option>
                                                                    <option>Viernes</option>
                                                                    <option>Sábado</option>
                                                                    <option>Domingo</option>
                                                                </select>
                                                            </div>
                                                            @error('día') <span class="text-danger error">{{ $message }}</span>@enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label">
                                                                {{ __('Hora de entrada') }}
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="time" id="hora_de_entrada" class="form-control" wire:model="hora_de_entrada">
                                                            @error('hora_de_entrada') <span class="text-danger error">{{ $message }}</span>@enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label">
                                                                {{ __('Hora de salida') }}
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="time" id="hora_de_salida" class="form-control" wire:model="hora_de_salida">
                                                            @error('hora_de_salida') <span class="text-danger error">{{ $message }}</span>@enderror
                                                        </div>
                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-sm btn-success">Guardar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @isset($schedule)
                                        <!-- Modal edit -->
                                        <div wire:ignore.self class="modal fade" id="editScheduleModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title">Editar día del horario</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h1 class="text-center"><span class="badge badge-secondary">{{$schedule->día}}</span></h1>
                                                        <form wire:submit.prevent="editScheduleData({{$schedule}})">
                                                            <div class="form-group">
                                                                <label class="col-form-label">
                                                                    {{ __('Hora de entrada') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="time" id="hora_de_entrada" class="form-control" wire:model="hora_de_entrada">
                                                                @error('hora_de_entrada') <span class="text-danger error">{{ $message }}</span>@enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-form-label">
                                                                    {{ __('Hora de salida') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="time" id="hora_de_salida" class="form-control" wire:model="hora_de_salida">
                                                                @error('hora_de_salida') <span class="text-danger error">{{ $message }}</span>@enderror
                                                            </div>
                                                            <div class="text-center">
                                                                <button type="submit" class="btn btn-sm btn-success">Guardar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endisset
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
                                        <p class="text-danger text-center py-4 mb-1"><b>Sin checks.</b></p>
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

    <!-- DELET SCHEDULE -->
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

    <script>
        window.addEventListener('close-modal', event =>{
            $('#createScheduleModal').modal('hide');
            $('#editScheduleModal').modal('hide');
            $('#deleteStudentModal').modal('hide');
        });

        window.addEventListener('show-edit-schedule-modal', event =>{
            $('#editScheduleModal').modal('show');
        });

    </script>

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
            '¡Eliminado!',
            'El día del horario se elimino con éxito.',
            'success'
            )
        </script>
        @endif

        <script>
        $('.alert-delete').submit(function (e) {
        e.preventDefault();
        Swal.fire({
        title: '¿Estas seguro?',
        text: "El día del horario se eliminara definitivamente",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, ¡Eliminar!',
        cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    </script>
@endpush