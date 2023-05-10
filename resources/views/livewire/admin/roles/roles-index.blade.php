<div class="pt-4">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center my-2">Todos los roles <span class="badge badge-light"> {{$roles_all}}</span></h5>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col-xl-11 col-lg-10 col-md-10 col-sm-10">
                    <div class="input-group my-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></div>
                        </div>
                        <input wire:model="search" class="form-control" placeholder="Ingrese el nombre del rol">
                    </div>
                </div>
                <div class="col-xl-1 col-lg-2 col-md-2 col-sm-2">
                    <a class="btn btn-success btn-block  my-2 @cannot('admin.roles.create') disabled @endcannot" href="{{ route('admin.roles.create') }}"><i class="fa-solid fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body p-0 table-responsive">
            @if ($roles->count())
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            @can('admin.roles.edit')
                                <th></th>
                            @endcan
                            @can('admin.roles.destroy')
                                <th></th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{$role->id}}</td>
                                <td>
                                    {{$role->name}}
                                </td>
                                @if($role->name != 'Admin')
                                    @can('admin.roles.edit')
                                        <td width="10px"><a class="btn btn-default btn-sm" href="{{ route('admin.roles.edit', $role) }}"><i class="fas fa-edit"></i></a></td>
                                    @endcan
                                    @can('admin.roles.destroy')
                                        <td width="10px">
                                            <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="alert-delete">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="delete()"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    @endcan
                                @else
                                    @can('admin.roles.edit')
                                        <td></td>
                                    @endcan
                                    @can('admin.roles.destroy')
                                        <td></td>
                                    @endcan
                                @endif
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
        <div class="card-footer pagination-sm">
            {{$roles->links()}}
        </div>
    </div>
</div>

@push('js')
    <script>
       Livewire.on('deleterole', roleId => {
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: '¿Estas seguro?',
            text: "El signatario se eliminara definitivamente",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, Eliminalo',
            cancelButtonText: 'No, Cancelar',
            reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emitTo('admin.roles.roles-index', 'delete', roleId);

                    swalWithBootstrapButtons.fire(
                    'Eliminado',
                    'El signatario fue eliminado con éxito.',
                    'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'Salir',
                    'error'
                    )
                }
            })
       })
    </script>
@endpush

@push('js')
    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
            '¡Eliminado!',
            'El rol se elimino con éxito.',
            'success'
            )
        </script>
    @endif

    <script>
        $('.alert-delete').submit(function (e) {
        e.preventDefault();
        Swal.fire({
        title: '¿Estas seguro?',
        text: "El rol se eliminara definitivamente",
        icon: 'warning',
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
