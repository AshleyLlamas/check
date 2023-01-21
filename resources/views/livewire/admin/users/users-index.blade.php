<div class="pt-4">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center my-2"><i class="fa-solid fa-list"></i> Todos los empleados <span class="badge badge-light"> {{$all_users}}</span></h5>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col-xl-8 col-lg-7 col-md-7 col-sm-7">
                    <div class="input-group my-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></div>
                        </div>
                        <input wire:model="search" class="form-control" placeholder="Ingrese el nombre del empleado">
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group my-2" wire:model="order">
                        <select class="form-control">
                        <option value="1">Ordernar por más reciente</option>
                        <option value="2">Ordernar por más antiguo</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-1 col-lg-2 col-md-2 col-sm-2">
                    <a class="btn btn-success btn-block  my-2 @cannot('admin.users.create') disabled @endcannot" href="{{ route('admin.users.create') }}"><i class="fa-solid fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body p-0 table-responsive">
            @if ($users->count())
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Número de empleado</th>
                            <th>Puesto</th>
                            @can('admin.users.show')
                                <th></th>
                            @endcan
                            @can('admin.users.edit')
                                <th></th>
                            @endcan
                            @can('admin.users.destroy')
                                <th></th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>
                                    @isset($user->name)
                                        @can('admin.users.show')
                                            <a href="{{ route('admin.users.show', $user) }}">{{$user->name}}</a>
                                        @else
                                            {{$user->name}}
                                        @endcan
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
                                </td>
                                <td>
                                    @isset($user->puesto)
                                        {{$user->puesto}}
                                    @else
                                        N/A
                                    @endisset
                                </td>
                                @can('admin.users.show')
                                    <td width="10px"><a class="btn btn-default btn-sm" href="{{route('admin.users.show', $user)}}"><i class="fas fa-eye"></i></a></td>
                                @endcan
                                @can('admin.users.edit')
                                    <td width="10px"><a class="btn btn-default btn-sm" href="{{route('admin.users.edit', $user)}}"><i class="fas fa-edit"></i></a></td>
                                @endcan
                                @can('admin.users.destroy')
                                    <td width="10px">
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="alert-delete">
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
                <div class="my-5">
                    <p class="text-center text-danger"><strong>Sin registro</strong></p>
                </div>
            @endif
        </div>
        <div class="card-footer">
            {{$users->links()}}
        </div>
    </div>
</div>

@push('js')
    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
            '¡Eliminado!',
            'El empleado se elimino con éxito.',
            'success'
            )
        </script>
    @endif

    <script>
        $('.alert-delete').submit(function (e) {
        e.preventDefault();
        Swal.fire({
        title: '¿Estas seguro?',
        text: "El empleado se eliminara definitivamente",
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