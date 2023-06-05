<div>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @can('admin.vacations.index')
                <li class="breadcrumb-item"><a href="{{route('admin.vacations.index')}}">Todas las solicitudes de vacaciones</a></li>
            @endcan
            <li class="breadcrumb-item active">Ver solicitud de vacaciones</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center mb-1">Ver solicitud de vacaciones</h5>
        </div>
        <div class="card-body">
            <div class="p-3 text-center row">
                <div class="col">
                    <div class="border rounded bg-light p-4 h-100">
                        <h5 class="mb-1"><b><i class="fa-solid fa-user"></i> Usuario:</b><br>
                            @can('admin.users.show')
                                <a href="{{route('admin.users.show', $vacation->user)}}">{{$vacation->user->name}}</a>
                            @else
                                <p class="text-secondary">
                                    {{$vacation->user->name}}
                                </p>
                            @endcan
                        </h5>
                    </div>
                </div>
                <div class="col">
                    <div class="border rounded
                        @switch($vacation->estatus)
                            @case('Aprobado')
                                    bg-success
                                @break
                            @case('En espera')
                                    bg-secondary
                                @break
                            @case('No aprobado')
                                    bg-danger
                                @break
                            @default
                                
                        @endswitch
                         p-4 h-100">
                        <h5 class="mb-1"><b><i class="fa-solid fa-magnifying-glass"></i> Estatus:</b><br> <p class="text-white">{{$vacation->estatus}}</p></h5> 
                    </div>
                </div>
                <div class="col">
                    <div class="border rounded bg-light p-4 h-100">
                        <h5 class="mb-1"><b><i class="fa-regular fa-calendar"></i> Fechas:</b><br> <p class="text-secondary">{{$vacation->fecha_inicial->formatlocalized('%d/%m/%Y')}} - {{$vacation->fecha_final->formatlocalized('%d/%m/%Y')}}</p></h5> 
                    </div>
                </div>
            </div>
            <div class="p-4">
                <div id='calendar' wire:ignore></div>
            </div>
            @if (session()->has('message'))
                <div class="alert alert-success text-center"><i class="fa-solid fa-circle-check"></i> {{ session('message') }}</div>
            @endif
            <div class="row">
                <div class="col">
                    <table class="table table-borderless rounded">
                        <thead class="border-bottom text-center">
                            <tr>
                                <th scope="col" class="border-right"><i class="fa-solid fa-users"></i></th>
                                <th scope="col"><i class="fa-solid fa-thumbs-up"></i> Aprobación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-bottom">
                                <th scope="col" class="border-right text-center align-middle">
                                    Jefe
                                    @isset($vacation->approval_jefe)
                                        @can('admin.users.show')
                                            <p><a href="{{route('admin.users.show', $vacation->approval_jefe->user)}}">{{$vacation->approval_jefe->user->name}}</a></p>
                                        @else
                                            <p class="text-secondary">
                                                {{$vacation->approval_jefe->user->name}}
                                            </p>
                                        @endcan
                                    @endisset
                                </th>
                                <th scope="row">
                                    @isset($vacation->approval_jefe)
                                        <div class="text-center pb-3">
                                            <span class="badge badge-pill @if($vacation->approval_jefe->aprobación == 'Aprobado') badge-success @else badge-danger @endif">{{$vacation->approval_jefe->aprobación}}</span>
                                        </div>
                                        <div class="rounded bg-light p-2">
                                            {!!$vacation->approval_jefe->observaciones!!}
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
                                <th scope="col" class="border-right text-center align-middle">
                                    Recursos humanos
                                    @isset($vacation->approval_rh)
                                        @can('admin.users.show')
                                            <p><a href="{{route('admin.users.show', $vacation->approval_rh->user)}}">{{$vacation->approval_rh->user->name}}</a></p>
                                        @else
                                            <p class="text-secondary">
                                                {{$vacation->approval_rh->user->name}}
                                            </p>
                                        @endcan
                                    @endisset
                                </th>
                                <th scope="row">
                                    @isset($vacation->approval_rh)
                                        <div class="text-center pb-3">
                                            <span class="badge badge-pill @if($vacation->approval_rh->aprobación == 'Aprobado') badge-success @else badge-danger @endif">{{$vacation->approval_rh->aprobación}}</span>
                                        </div>
                                        <div class="rounded bg-light p-2">
                                            {!!$vacation->approval_rh->observaciones!!}
                                        </div>
                                    @else
                                        @if (Auth::user()->hasRole(6) || Auth::user()->hasRole(1))
                                            <div  class="row justify-content-center">
                                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#createApprovalRhModal"><i class="fa-solid fa-plus"></i> Crear aprobación</button>
                                            </div>
                                        @endif
                                    @endisset
                                </th>
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
                <!--Cerrar modal-->

            </div>
        </div>
    </div>
</div>

@push('js')

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        $('#observaciones').summernote({
            tabsize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('observaciones', contents);
                }
            }
        });
    </script>

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
            $('#createApprovalJefeModal').modal('hide');
            $('#createApprovalRhModal').modal('hide');
            $('#createApprovalDgModal').modal('hide');
        });
    </script>
@endpush