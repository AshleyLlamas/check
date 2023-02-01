<div class="pt-4">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center my-2"><i class="fa-solid fa-list"></i> Todas las actas administrativas <span class="badge badge-light"> {{$all_administrative_records}}</span></h5>
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
                    <a class="btn btn-success btn-block  my-2 @cannot('admin.administrative_records.create') disabled @endcannot" href="{{ route('admin.administrative_records.create') }}"><i class="fa-solid fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body p-0 table-responsive">
            @if ($administrative_records->count())
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Colaborador</th>
                            <th>Tipo de amonestación</th>
                            <th>Permiso</th>
                            @can('admin.administrative_records.show')
                                <th></th>
                            @endcan
                            @can('admin.administrative_records.edit')
                                <th></th>
                            @endcan
                            @can('admin.administrative_records.destroy')
                                <th></th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($administrative_records as $administrative_record)
                            <tr>
                                <td>{{$administrative_record->id}}</td>
                                <td>
                                    @isset($administrative_record->colaborador)
                                        @can('admin.users.show')
                                            <a href="{{ route('admin.users.show', $administrative_record->colaborador) }}">{{$administrative_record->colaborador->name}}</a>
                                        @else
                                            {{$administrative_record->colaborador->name}}
                                        @endcan
                                    @else
                                        N/A
                                    @endisset
                                </td>
                                <td>
                                    @isset($administrative_record->admonitionType)
                                       {{$administrative_record->admonitionType->tipo}}
                                    @else
                                        N/A
                                    @endisset
                                </td>
                                <td>
                                    @if(isset($administrative_record->categoria_del_permiso) && $administrative_record->fecha_del_permiso)
                                       <b>{{$administrative_record->categoria_del_permiso}}:</b> {{$administrative_record->fecha_del_permiso->format('d/m/Y')}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                @can('admin.administrative_records.show')
                                    <td width="10px"><a class="btn btn-default btn-sm" href="{{route('admin.administrative_records.show', $administrative_record)}}"><i class="fas fa-eye"></i></a></td>
                                @endcan
                                @can('admin.administrative_records.edit')
                                    <td width="10px"><a class="btn btn-default btn-sm" href="{{route('admin.administrative_records.edit', $administrative_record)}}"><i class="fas fa-edit"></i></a></td>
                                @endcan
                                @can('admin.administrative_records.destroy')
                                    <td width="10px">
                                        <form action="{{ route('admin.administrative_records.destroy', $administrative_record) }}" method="POST" class="alert-delete">
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
            {{$administrative_records->links()}}
        </div>
    </div>
</div>

@push('js')
    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
            '¡Eliminado!',
            'La acta administrativa se elimino con éxito.',
            'success'
            )
        </script>
    @endif

    <script>
        $('.alert-delete').submit(function (e) {
        e.preventDefault();
        Swal.fire({
        title: '¿Estas seguro?',
        text: "La acta administrativa se eliminara definitivamente",
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