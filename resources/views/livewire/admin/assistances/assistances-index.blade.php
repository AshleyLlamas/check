<div class="pt-4">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @if ($all_assistances != 0)
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <h5>Asistencias de empleados con fotografía <i class="fa-solid fa-image"></i></h5>
                        <hr>
                        <p><b>{{$usuariosConFoto}}/{{$all_assistances}}</b></p>
                        <div class="mx-5 progress" style="height: 3px;">
                            <div class="progress-bar" style="width: {{($usuariosConFoto/$all_assistances)*100}}%"></div>
                        </div>
                        <p class="text-danger"><small>{{$usuariosSinFoto}} empleados no tienen fotografía</small></p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center my-2"><i class="fa-solid fa-list"></i> Todas las asistencias <span class="badge badge-light"> {{$all_assistances}}</span></h5>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                    <div class="input-group my-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></div>
                        </div>
                        <input type="date" wire:model="date" class="form-control">
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                    <div class="form-group my-2" wire:model="order">
                        <select class="form-control" id="orderFormControlSelect">
                        <option value="1">Ordernar por más reciente</option>
                        <option value="2">Ordernar por más antiguo</option>
                        </select>
                    </div>
                </div>
            </div>
            <div>
                Justificación:
                <span class="badge badge-success">Aprobada</span>
                <span class="badge badge-danger">No aprobada</span>
                <span class="badge badge-warning">En espera</span>
            </div>
        </div>
        <div class="card-body p-0 table-responsive">
            @if ($assistances->count())
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>Estatus</th>
                            <th>observación</th>
                            @can('admin.assistances.show')
                                <th></th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assistances as $assistance)
                            <tr @isset($assistance->justify_attendance)
                                class="
                                @switch($assistance->justify_attendance)
                                    @case("No aprobado")
                                        bg-danger
                                        @break
                                    @case("Aprobado")
                                        bg-success
                                        @break
                                    @default
                                        bg-warning
                                @endswitch
                                "
                            @endisset>
                                <td>{{$assistance->id}}</td>
                                <td>
                                    @isset($assistance->user_id)
                                        @can('admin.users.show')
                                            <a href="{{ route('admin.users.show', $assistance->user) }}">{{$assistance->user->name}}</a>
                                        @else
                                            {{$assistance->user->name}}
                                        @endcan
                                    @else
                                        N/A
                                    @endisset
                                </td>
                                <td>
                                    @isset($assistance->asistencia)
                                        {{$assistance->asistencia}}
                                    @endisset
                                </td>
                                <td>
                                    @isset($assistance->observación)
                                        {{$assistance->observación}}
                                    @else
                                        N/A
                                    @endisset
                                </td>
                                @can('admin.assistances.show')
                                    <td width="10px"><a class="btn btn-default btn-sm" href="{{route('admin.assistances.show', $assistance)}}"><i class="fas fa-eye"></i></a></td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="my-5">
                    <p class="text-center text-danger"><strong>Sin registro</strong></p>
                </div>
            @endif
        </div>
        <div class="card-footer">
            {{$assistances->links()}}
        </div>
    </div>
</div>
