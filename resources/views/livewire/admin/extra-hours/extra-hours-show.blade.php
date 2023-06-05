<div>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @can('admin.extra_hours.index')
                <li class="breadcrumb-item"><a href="{{route('admin.extra_hours.index')}}">Todas las horas extras</a></li>
            @endcan
            <li class="breadcrumb-item active">Ver hora extra</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center mb-1">Hora extra</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6 col-xl-6">
                    <a href="{{ route('admin.users.show', $extraHour->user) }}">
                        <div class="card bg-light shadow-none border h-100">
                            <div class="row  m-3 pt-2">
                                <div class="col-4">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                        src="@if($extraHour->user->image) {{route('images', $extraHour->user->image)}} @else {{asset('recursos/foto-default.png')}} @endif"
                                        alt="Fotografía">
                                    </div>
                                </div>
                                <div class="col-8">
                                    <h3 class="profile-username text-center">{{$extraHour->user->name}}</h3>

                                    @isset($extraHour->user->puesto)
                                        <p class="text-muted text-center mb-0 pb-0">{{$extraHour->user->puesto}}</p>
                                    @endisset
                                    @isset($extraHour->user->tipo_de_puesto)
                                        <p class="text-muted text-center mb-1"><small>({{$extraHour->user->tipo_de_puesto}})</small></p>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-xl-6">
                    <div class="card shadow-none border h-100">
                        <div class="text-center pt-4">
                            <h5 class="mb"><b><i class="fa-regular fa-calendar"></i> Fecha</b> <br> <p class="text-secondary">{{$extraHour->fecha->formatlocalized('%d/%m/%Y')}}</p></h5>
                            <h5 class="mb-1"><b>Horas extras</h5></b><h3> {{$extraHour->horas}} Hrs. </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-3">
                <div class="border rounded">
                    @isset ($extraHour->assistance->check)
                        <table class="table table-borderless rounded text-center">
                            <thead class="border-bottom">
                                <tr>
                                    <th scope="col" class="border-right"><i class="fa-solid fa-door-open"></i></th>
                                    <th scope="col"><i class="fa-solid fa-clock"></i> Hora</th>
                                    <th scope="col"><i class="fa-solid fa-magnifying-glass"></i> Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($extraHour->assistance->check->in)
                                    <tr class="border-bottom">
                                        <th scope="col" class="border-right">Entrada @isset($extraHour->assistance->check->schedule) ({{$extraHour->assistance->check->schedule->hora_de_entrada->format('h:i A')}}) @endisset</th>
                                        <th scope="row">{{$extraHour->assistance->check->in->hora->format('h:i:s A')}}</th>
                                        <td>{{$extraHour->assistance->check->in->estatus}}</td>
                                    </tr>
                                @endisset
                                @isset($extraHour->assistance->check->out)
                                    <tr class="border-bottom">
                                        <th scope="col" class="border-right">Salida @isset($extraHour->assistance->check->schedule) ({{$extraHour->assistance->check->schedule->hora_de_salida->format('h:i A')}}) @endisset</th>
                                        <th scope="row">{{$extraHour->assistance->check->out->hora->format('h:i:s A')}}</th>
                                        <td>{{$extraHour->assistance->check->out->estatus}}</td>
                                    </tr>
                                @endisset
                            </tbody>
                        </table>
                    @endisset
                        @if (session()->has('message'))
                            <div class="alert alert-success text-center m-3"><i class="fa-solid fa-circle-check"></i> {{ session('message') }}</div>
                        @endif
                        <div>
                            <table class="table table-borderless rounded">
                                <thead class="border-bottom text-center">
                                    <tr class="border-bottom">
                                        <td colspan="2">
                                            <div class="pb-3">
                                                <h5 class="mb-1"><b>Estatus:</b></h5>
                                                <span class="badge badge-secondary">
                                                {{$extraHour->estatus}}</span>
                                            </div>
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
                                            @isset($extraHour->approval_jefe)
                                                @can('admin.users.show')
                                                    <p><a href="{{route('admin.users.show', $extraHour->approval_jefe->user)}}">{{$extraHour->approval_jefe->user->name}}</a></p>
                                                @else
                                                    <p class="text-secondary">
                                                        {{$extraHour->approval_jefe->user->name}}
                                                    </p>
                                                @endcan
                                            @endisset
                                        </th>
                                        <th scope="row">
                                            @isset($extraHour->approval_jefe)
                                                <div class="text-center pb-3">
                                                    <span class="badge badge-pill @if($extraHour->approval_jefe->aprobación == 'Aprobado') badge-success @else badge-danger @endif">{{$extraHour->approval_jefe->aprobación}}</span>
                                                </div>
                                                <div class="rounded bg-light p-2">
                                                    {!!$extraHour->approval_jefe->observaciones!!}
                                                </div>
                                            @else
                                                @if ($justificarComoJefe != 0 || Auth::user()->hasRole(1))
                                                    <div  class="row justify-content-center">
                                                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#createApprovalJefeModal"><i class="fa-solid fa-plus"></i> Crear aprobación</button>
                                                    </div>
                                                @endif
                                            @endisset
                                        </th>
                                    </tr>
                                    <tr class="border-bottom">
                                        <tr>
                                            <th scope="col" class="border-right text-center align-middle">
                                               Director general
                                                @isset($extraHour->approval_dg)
                                                    @can('admin.users.show')
                                                        <p><a href="{{route('admin.users.show', $extraHour->approval_dg->user)}}">{{$extraHour->approval_dg->user->name}}</a></p>
                                                    @else
                                                        <p class="text-secondary">
                                                            {{$extraHour->approval_dg->user->name}}
                                                        </p>
                                                    @endcan
                                                @endisset
                                            </th>
                                            <th scope="row">
                                                @isset($extraHour->approval_dg)
                                                    <div class="text-center pb-3">
                                                        <span class="badge badge-pill @if($extraHour->approval_dg->aprobación == 'Aprobado') badge-success @else badge-danger @endif">{{$extraHour->approval_dg->aprobación}}</span>
                                                    </div>
                                                    <div class="rounded bg-light p-2">
                                                        {!!$extraHour->approval_dg->observaciones!!}
                                                    </div>
                                                @else
                                                    @if (Auth::user()->hasRole(2) || Auth::user()->hasRole(1))
                                                        <div  class="row justify-content-center">
                                                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#createApprovalDgModal"><i class="fa-solid fa-plus"></i> Crear aprobación</button>
                                                        </div>
                                                    @endif
                                                @endisset
                                            </th>
                                        </tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
                        <div wire:ignore.self class="modal fade" id="createApprovalDgModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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

                                            <form wire:submit.prevent="createApprovalDg">
                                                @include('admin.vacations.partials.form-approval')
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            $('#createApprovalDgModal').modal('hide');
        });
    </script>
@endpush
