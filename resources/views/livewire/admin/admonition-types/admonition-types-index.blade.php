<div class="pt-4">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center my-2"><i class="fa-solid fa-list"></i> Todos los tipos de amonestación <span class="badge badge-light"> {{$all_admonition_types}}</span></h5>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col-xl-11 col-lg-10 col-md-10 col-sm-10">
                    <div class="form-group my-2" wire:model="order">
                        <select class="form-control" id="orderFormControlSelect">
                        <option value="1">Ordernar por más reciente</option>
                        <option value="2">Ordernar por más antiguo</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-1 col-lg-2 col-md-2 col-sm-2">
                    <a class="btn btn-success btn-block  my-2 @cannot('admin.admonition_types.create') disabled @endcannot" href="{{ route('admin.admonition_types.create') }}"><i class="fa-solid fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body p-0 table-responsive">
            @if ($admonition_types->count())
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo</th>
                            {{-- @can('admin.admonition_types.show')
                                <th></th>
                            @endcan --}}
                            @can('admin.admonition_types.edit')
                                <th></th>
                            @endcan
                            @can('admin.admonition_types.destroy')
                                <th></th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admonition_types as $admonition_type)
                            <tr>
                                <td>{{$admonition_type->id}}</td>
                                <td>
                                    @isset($admonition_type->tipo)
                                        {{$admonition_type->tipo}}
                                    @else
                                        N/A
                                    @endisset
                                </td>
                                {{-- @can('admin.admonition_types.show')
                                    <td width="10px"><a class="btn btn-default btn-sm" href="{{route('admin.admonition_types.show', $admonition_type)}}"><i class="fas fa-eye"></i></a></td>
                                @endcan --}}
                                @can('admin.admonition_types.edit')
                                    <td width="10px"><a class="btn btn-default btn-sm" href="{{route('admin.admonition_types.edit', $admonition_type)}}"><i class="fas fa-edit"></i></a></td>
                                @endcan
                                @can('admin.admonition_types.destroy')
                                    <td width="10px">
                                        <form action="{{ route('admin.admonition_types.destroy', $admonition_type) }}" method="POST" class="alert-delete">
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
            {{$admonition_types->links()}}
        </div>
    </div>
</div>

@push('js')
    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
            '¡Eliminado!',
            'El tipo de amonestación se elimino con éxito.',
            'success'
            )
        </script>
    @endif

    <script>
        $('.alert-delete').submit(function (e) {
        e.preventDefault();
        Swal.fire({
        title: '¿Estas seguro?',
        text: "El tipo de amonestación se eliminara definitivamente",
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