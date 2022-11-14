<div class="pt-4">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header bg-info">
            <h5 class="text-center my-2"><i class="fa-solid fa-list"></i> Todos los checadores <span class="badge badge-light"> {{$all_checks}}</span></h5>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                    <div class="input-group my-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></div>
                        </div>
                        <input type="date" wire:model="search" class="form-control">
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
        </div>
        <div class="card-body p-0 table-responsive">
            @if ($checks->count())
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>Entrada</th>
                            <th>Salida</th>
                            <th>Estatus</th>
                            @can('admin.checks.show')
                                <th></th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($checks as $check)
                            <tr>
                                <td>{{$check->id}}</td>
                                <td>
                                    @isset($check->user_id)
                                        @can('admin.users.show')
                                            <a href="{{ route('admin.users.show', $check->user) }}">{{$check->user->name}}</a>
                                        @else
                                            {{$check->user->name}}
                                        @endcan
                                    @else
                                        N/A
                                    @endisset
                                </td>
                                <td>
                                    @isset($check->in)
                                        {{$check->in->hora}}
                                    @else
                                        N/A
                                    @endisset
                                </td>
                                <td>
                                    @isset($check->out)
                                        {{$check->out->hora}}
                                    @else
                                        N/A
                                    @endisset
                                </td>
                                <td>
                                    @isset($check->assistance)
                                        <i class="fa-solid fa-circle-check" style="color: green"></i>
                                    @else
                                        <i class="fa-solid fa-hourglass-start" style="color: gray"></i>
                                    @endisset
                                </td>
                                @can('admin.checks.show')
                                    <td width="10px"><a class="btn btn-default btn-sm" href="{{route('admin.checks.show', $check)}}"><i class="fas fa-eye"></i></a></td>
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
            {{$checks->links()}}
        </div>
    </div>
</div>

@push('js')
    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
            '¡Eliminado!',
            'El usuario se elimino con éxito.',
            'success'
            )
        </script>
    @endif

    <script>
        $('.alert-delete').submit(function (e) {
        e.preventDefault();
        Swal.fire({
        title: '¿Estas seguro?',
        text: "El usuario se eliminara definitivamente",
        icon: 'info',
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