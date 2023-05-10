<div class="pt-4">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center my-2"><i class="fa-solid fa-list"></i> Todas las incidencias <span class="badge badge-light"> {{$all_safeties}}</span></h5>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col-xl-11 col-lg-10 col-md-12 col-sm-12">

                </div>
                <div class="col-xl-1 col-lg-2 col-md-12 col-sm-12">
                    <a class="btn btn-success btn-block  my-2 @cannot('admin.safeties.create') disabled @endcannot" href="{{ route('admin.safeties.create') }}"><i class="fa-solid fa-plus"></i></a>
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
                            <th class="m-2" colspan="4">
                                <select class="form-control form-control-sm text-center" wire:model="order">
                                    <option value="1">Ordenar por más reciente (# ID)</option>
                                    <option value="2">Ordenar por más antiguo (# ID)</option>
                                </select>
                            </th>
                            @can('admin.safeties.show')
                                <th></th>
                            @endcan
                            @can('admin.safeties.edit')
                                <th></th>
                            @endcan
                            @can('admin.safeties.destroy')
                                <th></th>
                            @endcan
                        </tr>
                        <tr class="bg-light">
                            <th>
                                <span>Filtrar por:</span>
                            </th>
                            <th class="m-2">
                                <select class="form-control form-control-sm text-center" id="searchTipo" wire:model="searchTipo">
                                    <option value="">-- Tipo --</option>
                                    <option value="Fatalidad">Fatalidad</option>
                                    <option value="Primeros auxios">Primeros auxios</option>
                                    <option value="Accidentes de trabajo">Accidentes de trabajo</option>
                                    <option value="Incidentes a la propiedad">Incidentes a la propiedad</option>
                                    <option value="Incidentes ambientables">Incidentes ambientables</option>
                                </select>
                            </th>
                            <th class="m-2">
                                <input wire:model="searchUser" class="form-control form-control-sm text-center" placeholder="Nombre del usuario">
                            </th>
                            <th class="m-2">
                                <input type='date' wire:model="searchFecha" class="form-control form-control-sm text-center" placeholder="Fecha">
                            </th>
                            <th class="m-2">
                                <select class="form-control form-control-sm text-center" id="área" wire:model="área">
                                    <option value="">-- Área / Proyecto --</option>
                                    @foreach ($areas as $area)
                                        <option value="{{$area->id}}">{{$area->área}}</option>
                                    @endforeach
                                </select>
                            </th>
                            @can('admin.safeties.show')
                                <th class="p-0"></th>
                            @endcan
                            @can('admin.safeties.edit')
                                <th class="p-0"></th>
                            @endcan
                            @can('admin.safeties.destroy')
                                <th class="p-0"></th>
                            @endcan
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Tipo</th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                            <th>Área / Proyecto</th>
                            @can('admin.safeties.show')
                                <th></th>
                            @endcan
                            @can('admin.safeties.edit')
                                <th></th>
                            @endcan
                            @can('admin.safeties.destroy')
                                <th></th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @if ($safeties->count())
                            @foreach ($safeties as $safety)
                            <tr>
                                <td>{{$safety->id}}</td>
                                <td>
                                    @isset($safety->tipo)
                                        {{$safety->tipo}}
                                    @else
                                        N/A
                                    @endisset
                                </td>
                                <td>
                                    @isset($safety->user)
                                        @can('admin.users.show')
                                            <a href="{{ route('admin.users.show', $safety->user) }}">{{$safety->user->name}}</a>
                                        @else
                                            {{$safety->user->name}}
                                        @endcan
                                    @else
                                        N/A
                                    @endisset
                                </td>
                                <td>
                                    @isset($safety->fecha)
                                        {{$safety->fecha->format('d-m-Y');}}
                                    @else
                                        N/A
                                    @endisset
                                </td>
                                <td>
                                    @isset($safety->area)
                                        @can('admin.areas.show')
                                            <a href="{{ route('admin.areas.show', $safety->area) }}">{{$safety->area->área}}</a>
                                        @else
                                            {{$safety->area->área}}
                                        @endcan
                                    @else
                                        N/A
                                    @endisset
                                </td>
                                @can('admin.safeties.show')
                                    <td width="10px"><a class="btn btn-default btn-sm" href="{{route('admin.safeties.show', $safety)}}"><i class="fas fa-eye"></i></a></td>
                                @endcan
                                @can('admin.safeties.edit')
                                    <td width="10px"><a class="btn btn-default btn-sm" href="{{route('admin.safeties.edit', $safety)}}"><i class="fas fa-edit"></i></a></td>
                                @endcan
                                @can('admin.safeties.destroy')
                                    <td width="10px">
                                        <form action="{{ route('admin.safeties.destroy', $safety) }}" method="POST" class="alert-delete">
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
            {{$safeties->links()}}
        </div>
    </div>
</div>

@push('js')
    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
            '¡Eliminado!',
            'El incidente se elimino con éxito.',
            'success'
            )
        </script>
    @endif

    <script>
        $('.alert-delete').submit(function (e) {
        e.preventDefault();
        Swal.fire({
        title: '¿Estas seguro?',
        text: "El incidente se eliminara definitivamente",
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
