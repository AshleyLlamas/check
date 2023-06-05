<div>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @can('admin.assistances.index')
                <li class="breadcrumb-item"><a href="{{route('admin.assistances.index')}}">Todos las asistencias</a></li>
            @endcan
            <li class="breadcrumb-item active">Ver asistencia</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center mb-1">Asistencia</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6 col-xl-6">
                    <a href="{{ route('admin.users.show', $assistance->user) }}">
                        <div class="card bg-light shadow-none border h-100">
                            <div class="row  m-3 pt-2">
                                <div class="col-4">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                        src="@if($assistance->user->image) {{route('images', $assistance->user->image)}} @else {{asset('recursos/foto-default.png')}} @endif"
                                        alt="Fotografía">
                                    </div>
                                </div>
                                <div class="col-8">
                                    <h3 class="profile-username text-center">{{$assistance->user->name}}</h3>

                                    @isset($user->puesto)
                                        <p class="text-muted text-center mb-0 pb-0">{{$assistance->user->puesto}}</p>
                                    @endisset
                                    @isset($user->tipo_de_puesto)
                                        <p class="text-muted text-center mb-1"><small>({{$assistance->user->tipo_de_puesto}})</small></p>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- -->
                <div class="col-12 col-md-6 col-xl-6">
                    <div class="card shadow-none border h-100">
                        <div class="text-center pt-4">
                            <h5 class="mb"><b><i class="fa-regular fa-calendar"></i> Fecha</b> <br> <p class="text-secondary">{{$assistance->created_at->formatlocalized('%d/%m/%Y')}}</p></h5>
                            <h5 class="mb-1"><b>Asistencia</h5></b><h3><span class="badge @if($assistance->asistencia == 'Asistió') badge-success @else badge-danger @endif"> {{$assistance->asistencia}}</span></h3>
                            @isset($assistance->extra_hour->horas)
                                <h5 class="mb"><b>Horas extras</b> <br> <p class="text-secondary"><a href="{{route('admin.extra_hours.show', $assistance->extra_hour)}}">{{$assistance->extra_hour->horas}} Hrs.</a></p></h5>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-3">
                <div class="border rounded">
                    @isset ($assistance->check)
                        <table class="table table-borderless rounded text-center">
                            <thead class="border-bottom">
                                <tr>
                                    <th scope="col" class="border-right"><i class="fa-solid fa-door-open"></i></th>
                                    <th scope="col"><i class="fa-solid fa-clock"></i> Hora</th>
                                    <th scope="col"><i class="fa-solid fa-magnifying-glass"></i> Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($assistance->check->in)
                                    <tr class="border-bottom">
                                        <th scope="col" class="border-right">Entrada @isset($assistance->check->schedule) ({{$assistance->check->schedule->hora_de_entrada->format('h:i A')}}) @endisset</th>
                                        <th scope="row">{{$assistance->check->in->hora->format('h:i:s A')}}</th>
                                        <td>{{$assistance->check->in->estatus}}</td>
                                    </tr>
                                @endisset
                                @isset($assistance->check->out)
                                    <tr class="border-bottom">
                                        <th scope="col" class="border-right">Salida @isset($assistance->check->schedule) ({{$assistance->check->schedule->hora_de_salida->format('h:i A')}}) @endisset</th>
                                        <th scope="row">{{$assistance->check->out->hora->format('h:i:s A')}}</th>
                                        <td>{{$assistance->check->out->estatus}}</td>
                                    </tr>
                                @endisset
                            </tbody>
                        </table>
                    @else
                        @if (session()->has('message'))
                            <div class="alert alert-success text-center m-3"><i class="fa-solid fa-circle-check"></i> {{ session('message') }}</div>
                        @endif

                        <div>
                            @isset($assistance->justify_attendance)
                                <table class="table table-borderless rounded">
                                    <thead class="border-bottom text-center">
                                        <tr class="border-bottom">
                                            <td colspan="2">
                                                <h5 class="mb-1"><b>Tipo de justificación:</b> <p class="text-secondary mb-1">{{$assistance->justify_attendance->tipo}}</p></h5>
                                                <span class="badge
                                                    @switch($assistance->justify_attendance->estatus)
                                                        @case('Asistió')
                                                            badge-success
                                                            @break
                                                        @case('No asistió')
                                                            badge-danger
                                                            @break
                                                        @default
                                                            badge-secondary
                                                    @endswitch
                                                ">
                                                {{$assistance->justify_attendance->estatus}}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="border-right"><i class="fa-solid fa-users"></i></th>
                                            <th scope="col"><i class="fa-solid fa-thumbs-up"></i> Aprobación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-bottom">
                                            <th scope="col" class="border-right text-center align-middle">
                                                Jefe
                                                @isset($assistance->justify_attendance->approval_jefe)
                                                    @can('admin.users.show')
                                                        <p><a href="{{route('admin.users.show', $assistance->justify_attendance->approval_jefe->user)}}">{{$assistance->justify_attendance->approval_jefe->user->name}}</a></p>
                                                    @else
                                                        <p class="text-secondary">
                                                            {{$assistance->justify_attendance->approval_jefe->user->name}}
                                                        </p>
                                                    @endcan
                                                @endisset
                                            </th>
                                            <th scope="row">
                                                @isset($assistance->justify_attendance->approval_jefe)
                                                    <div class="text-center pb-3">
                                                        <span class="badge badge-pill @if($assistance->justify_attendance->approval_jefe->aprobación == 'Aprobado') badge-success @else badge-danger @endif">{{$assistance->justify_attendance->approval_jefe->aprobación}}</span>
                                                    </div>
                                                    <div class="rounded bg-light p-2">
                                                        {!!$assistance->justify_attendance->approval_jefe->observaciones!!}
                                                    </div>
                                                @else
                                                    <div  class="row justify-content-center">
                                                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#createApprovalJefeModal"><i class="fa-solid fa-plus"></i> Crear aprobación</button>
                                                    </div>
                                                @endisset
                                            </th>
                                        </tr>
                                        <tr class="border-bottom">
                                            <th scope="col" class="border-right text-center align-middle">
                                                Recursos humanos
                                                @isset($assistance->justify_attendance->approval_rh)
                                                    @can('admin.users.show')
                                                        <p><a href="{{route('admin.users.show', $assistance->justify_attendance->approval_rh->user)}}">{{$assistance->justify_attendance->approval_rh->user->name}}</a></p>
                                                    @else
                                                        <p class="text-secondary">
                                                            {{$assistance->justify_attendance->approval_rh->user->name}}
                                                        </p>
                                                    @endcan
                                                @endisset
                                            </th>
                                            <th scope="row">
                                                @isset($assistance->justify_attendance->approval_rh)
                                                    <div class="text-center pb-3">
                                                        <span class="badge badge-pill @if($assistance->justify_attendance->approval_rh->aprobación == 'Aprobado') badge-success @else badge-danger @endif">{{$assistance->justify_attendance->approval_rh->aprobación}}</span>
                                                    </div>
                                                    <div class="rounded bg-light p-2">
                                                        {!!$assistance->justify_attendance->approval_rh->observaciones!!}
                                                    </div>
                                                @else
                                                    <div  class="row justify-content-center">
                                                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#createApprovalRhModal"><i class="fa-solid fa-plus"></i> Crear aprobación</button>
                                                    </div>
                                                @endisset
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>

                                <!-- Modal create -->
                                <div wire:ignore.self class="modal fade" id="createApprovalJefeModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title">Crear aprobación</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <form wire:submit.prevent="createApprovalJefe">
                                                        @include('admin.vacations.partials.form-approval')
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Cerrar modal-->

                                <!-- Modal create -->
                                <div wire:ignore.self class="modal fade" id="createApprovalRhModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title">Crear aprobación</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <form wire:submit.prevent="createApprovalRh">
                                                        @include('admin.vacations.partials.form-approval')
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Cerrar modal-->
                            @else
                                <div class="m-3">
                                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#createJustifyAttendanceModal"><i class="fa-solid fa-plus"></i> Crear justificante</button>
                                </div>

                                <!-- MODAL -->
                                <div wire:ignore.self class="modal fade" id="createJustifyAttendanceModal" tabindex="-1" aria-labelledby="createJustifyAttendanceModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title">Crear justificante</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <form wire:submit.prevent="createJustifyAttendance">
                                                    {{-- <div class="form-group">
                                                        <label class="col-form-label">
                                                            {{ __('Tipo de justificante') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" id="tipo" class="form-control" wire:model="tipo" placeholder="Ingrese el tipo">
                                                        @error('tipo') <span class="text-danger error">{{ $message }}</span>@enderror
                                                    </div> --}}

                                                    <div class="form-group">
                                                        <div >
                                                            <label class="col-form-label">
                                                                {{ __('Tipo de justificación') }}
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <select class="form-control"  wire:model="tipo">
                                                                <option value="">Selecciona una opción</option>
                                                                <option>Permiso con goce de sueldo</option>
                                                                <option>Permiso sin goce de sueldo</option>
                                                                <option>Permiso con goce de sueldo por paternidad</option>
                                                                <option>Permiso con goce de sueldo por fallecimiento de familiar directo</option>
                                                                <option>Permiso con goce de sueldo por premio en rifa navideña</option>
                                                                <option>Permiso con goce de sueldo por imposibilidad de checador</option>
                                                                <option>Permiso con goce por Falta de energía eléctrica</option>
                                                                <option>Permiso por envío a otra obra o dependencia o ciudad</option>
                                                                <option>Justificación por vacaciones</option>
                                                            </select>
                                                        </div>
                                                        @error('tipo') <span class="text-danger error">{{ $message }}</span>@enderror
                                                    </div>

                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-sm btn-success">Guardar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- MODAL -->
                            @endisset

                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        window.addEventListener('close-modal', event =>{
            $('#createApprovalJefeModal').modal('hide');
            $('#createApprovalRhModal').modal('hide');
            $('#createJustifyAttendanceModal').modal('hide');
        });
    </script>
@endpush
