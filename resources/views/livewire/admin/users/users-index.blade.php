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
                <div class="col-xl-11 col-lg-10 col-md-12 col-sm-12">

                </div>
                <div class="col-xl-1 col-lg-2 col-md-12 col-sm-12">
                    <a class="btn btn-success btn-block  my-2 @cannot('admin.users.create') disabled @endcannot" href="{{ route('admin.users.create') }}"><i class="fa-solid fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body p-0 table-responsive">
                <table class="table table-hover text-center">
                    <thead>
                        <tr class="bg-light">
                            <th>
                                <span>Ordenar por:</span>
                            </th>
                            <th class="m-2" colspan="5">
                                <select class="form-control form-control-sm text-center" wire:model="order">
                                    <option value="1">Ordenar por más reciente (# ID)</option>
                                    <option value="2">Ordenar por más antiguo (# ID)</option>
                                    <option value="3">Ordenar por número de empleado (Ascedente)</option>
                                    <option value="4">Ordenar por número de empleado (Decendente)</option>
                                    <option value="5">Ordenar por nombre (A-Z)</option>
                                    <option value="6">Ordenar por nombre (Z-A)</option>
                                </select>
                            </th>
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
                        <tr class="bg-light">
                            <th>
                                <span>Filtrar por:</span>
                            </th>
                            <th class="m-2">
                                <input wire:model="searchNumero" class="form-control form-control-sm text-center" placeholder="No.">
                            </th>
                            <th class="m-2">
                                <input wire:model="searchName" class="form-control form-control-sm text-center" placeholder="Nombre">
                            </th>
                            <th class="m-2">
                                <input wire:model="searchPuesto" class="form-control form-control-sm text-center" placeholder="Puesto">
                            </th>
                            <th class="m-2">
                                <select class="form-control form-control-sm text-center" id="área" wire:model="área">
                                    <option value="">-- Área / Proyecto --</option>
                                    @foreach ($areas as $area)
                                        <option value="{{$area->id}}">{{$area->área}}</option>
                                    @endforeach
                                </select>
                            </th>
                            <th class="m-2">
                                <select class="form-control form-control-sm text-center" id="compañia" wire:model="compañia">
                                    <option value="">-- Empresa / Compañia --</option>
                                    @foreach ($companies as $company)
                                        <option value="{{$company->id}}">{{$company->nombre_de_la_compañia}}</option>
                                    @endforeach
                                </select>
                            </th>
                            @can('admin.users.show')
                                <th class="p-0"></th>
                            @endcan
                            @can('admin.users.edit')
                                <th class="p-0"></th>
                            @endcan
                            @can('admin.users.destroy')
                                <th class="p-0"></th>
                            @endcan
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>No. de empleado</th>
                            <th>Nombre</th>
                            <th>Puesto</th>
                            <th>Área / Proyecto</th>
                            <th>Empresa</th>
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
                        @if ($users->count())
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>
                                        @isset($user->número_de_empleado)
                                            {{$user->número_de_empleado}}
                                        @else
                                            <span class="text-success">N/A</span>
                                        @endisset
                                    </td>
                                    <td>
                                        @isset($user->name)
                                            @can('admin.users.show')
                                                <a href="{{ route('admin.users.show', $user) }}">{{$user->name}}</a>
                                            @else
                                                {{$user->name}}
                                            @endcan
                                        @else
                                            <span class="text-success">N/A</span>
                                        @endisset
                                    </td>
                                    <td>
                                        @isset($user->puesto)
                                            {{$user->puesto}}
                                        @else
                                            <span class="text-success">N/A</span>
                                        @endisset
                                    </td>
                                    <td>
                                        @if($user->areas->count())
                                            {{$user->areas->first()->área}}
                                        @else
                                            <span class="text-success">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @isset($user->company)
                                            {{$user->company->nombre_de_la_compañia}}
                                        @else
                                            <span class="text-success">N/A</span>
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
                        @else
                            <tr scope="row">
                                <td colspan="6">
                                    <p class="text-center text-danger pt-3"><strong>Sin registro</strong></p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
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
