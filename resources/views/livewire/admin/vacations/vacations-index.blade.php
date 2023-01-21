<div class="pt-4">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center my-2"><i class="fa-solid fa-list"></i> Todas las solicitudes de vacaciones <span class="badge badge-light"> {{$all_vacations}}</span></h5>
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
                    <a class="btn btn-success btn-block  my-2 @cannot('admin.vacations.create') disabled @endcannot" href="{{ route('admin.vacations.create') }}"><i class="fa-solid fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body p-0 table-responsive">
            @if ($vacations->count())
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>Motivo</th>
                            <th>Fecha inicial</th>
                            <th>Fecha final</th>
                            <th>Estatus</th>
                            @can('admin.vacations.show')
                                <th></th>
                            @endcan
                            @can('admin.vacations.edit')
                                <th></th>
                            @endcan
                            @can('admin.vacations.destroy')
                                <th></th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vacations as $vacation)
                            <tr>
                                <td>{{$vacation->id}}</td>
                                <td>
                                    @isset($vacation->user)
                                        @can('admin.users.show')
                                            <a href="{{ route('admin.users.show', $vacation->user) }}">{{$vacation->user->name}}</a>
                                        @else
                                            {{$vacation->user->name}}
                                        @endcan
                                    @else
                                        N/A
                                    @endisset
                                </td>
                                <td>
                                    @isset($vacation->motivo)
                                        {{$vacation->motivo}}
                                    @else
                                        N/A
                                    @endisset
                                </td>
                                <td>
                                    @isset($vacation->fecha_inicial)
                                        {{$vacation->fecha_inicial->format('d/m/Y')}}
                                    @else
                                        N/A
                                    @endisset
                                </td>
                                <td>
                                    @isset($vacation->fecha_final)
                                        {{$vacation->fecha_final->format('d/m/Y')}}
                                    @else
                                        N/A
                                    @endisset
                                </td>
                                <td>
                                    @isset($vacation->estatus)
                                        @switch($vacation->estatus)
                                            @case('Aprobado')
                                                    <i class="fa-solid fa-circle-check" style="color: green"></i>
                                                @break
                                            @case('En espera')
                                                    <i class="fa-solid fa-hourglass-start" style="color: gray"></i>
                                                @break
                                            @case('No aprobado')
                                                    <i class="fa-solid fa-circle-xmark" style="color: red"></i>
                                                @break
                                            @default
                                                
                                        @endswitch
                                    @else
                                        N/A
                                    @endisset
                                </td>
                                @can('admin.vacations.show')
                                    <td width="10px"><a class="btn btn-default btn-sm" href="{{route('admin.vacations.show', $vacation)}}"><i class="fas fa-eye"></i></a></td>
                                @endcan
                                @can('admin.vacations.edit')
                                    <td width="10px"><a class="btn btn-default btn-sm" href="{{route('admin.vacations.edit', $vacation)}}"><i class="fas fa-edit"></i></a></td>
                                @endcan
                                @can('admin.vacations.destroy')
                                    <td width="10px">
                                        <form action="{{ route('admin.vacations.destroy', $vacation) }}" method="POST" class="alert-delete">
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
            {{$vacations->links()}}
        </div>
    </div>
</div>