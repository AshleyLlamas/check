<div>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @can('admin.default_schedules.index')
                <li class="breadcrumb-item"><a href="{{route('admin.default_schedules.index')}}">Todos los horarios predeterminados</a></li>
            @endcan
            <li class="breadcrumb-item active">Ver horario predeterminado</li>
        </ol>
    </nav>
    <div class="card card-primary">
        <div class="card-header">
            <h5 class="text-center pt-1">{{$default_schedule->nombre_del_horario}}</h5>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div>
                <div class="table-responsive">
                    @if($default_schedule->schedules->count())
                        <table class="table table-bordered">
                            <thead class="text-primary text-center">
                                <tr>
                                    <th scope="col">Día</th>
                                    <th scope="col">Entrada</th>
                                    <th scope="col">Salida</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($default_schedule->schedules as $n => $schedule)
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
