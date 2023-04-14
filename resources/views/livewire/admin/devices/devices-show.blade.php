<div>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @can('admin.devices.index')
                <li class="breadcrumb-item"><a href="{{route('admin.devices.index')}}">Todos los dispositivos</a></li>
            @endcan
            <li class="breadcrumb-item active">Ver dispositivo</li>
        </ol>
    </nav>
    <!-- Main content -->
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Yo -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa-solid fa-device"></i> Información</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                                <strong>Nombre</strong>

                                <p class="text-muted">
                                    @isset($device->name)
                                        {{$device->name}}
                                    @else
                                        N/A
                                    @endisset
                                </p>
                            <hr>
                                <strong>Correo</strong>

                                <p class="text-muted">
                                    @isset($device->email)
                                        {{$device->email}}
                                    @else
                                        N/A
                                    @endisset
                                </p>
                            <hr>
                                <strong>Encargado</strong>

                                <p class="text-muted">
                                    @isset($device->user_id)
                                        {{$device->user->name}}
                                    @else
                                        N/A
                                    @endisset
                                </p>
                            <hr>
                                <strong>Descripción</strong>

                                <p class="text-muted">
                                    @isset($device->descripción)
                                        {!!$device->descripción!!}
                                    @else
                                        N/A
                                    @endisset
                                </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <!-- Check -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Usuarios agregados</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body text-center m-0 p-0">
                            <div>
                                <div class="table-responsive">
                                    @if($device->inUsers->count())
                                        <table class="table table-striped table-hover text-center border">
                                            <thead>
                                                <tr>
                                                    <th scope="col"><h5 class="mb-1 pt-1">#</h5></th>
                                                    <th scope="col"><h5 class="mb-1 pt-1">Número de empleado</h5></th>
                                                    <th scope="col"><h5 class="mb-1 pt-1">Nombre</h5></th>
                                                    @can('admin.users.show')
                                                    <th width="10px"></th>
                                                    @endcan
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($device->inUsers as $user)
                                                    <tr>
                                                        <td>
                                                            @isset($user->id)
                                                                {{$user->id}}
                                                            @else
                                                                N/A
                                                            @endisset
                                                        </td>
                                                        <td>
                                                            @isset($user->número_de_empleado)
                                                                {{$user->número_de_empleado}}
                                                            @else
                                                                N/A
                                                            @endisset
                                                        </th>
                                                        <td>

                                                            @isset($user->name)
                                                                {{$user->name}}
                                                            @else
                                                                N/A
                                                            @endisset
                                                        </td>
                                                        @can('admin.users.show')
                                                            <td width="10px"><a class="btn btn-default btn-sm" href="{{route('admin.users.show', $user)}}"><i class="fas fa-eye"></i></a></td>
                                                        @endcan
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p class="text-danger text-center py-4 mb-1"><b>Sin usuarios.</b></p>
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
