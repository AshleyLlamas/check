<div class="py-4">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @can('admin.default_schedules.index')
                <li class="breadcrumb-item"><a href="{{route('admin.default_schedules.index')}}">Todos los horarios predeterminados</a></li>
            @endcan
            <li class="breadcrumb-item active">Nuevo horario predeterminado </li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center my-2">{{$nombre_del_horario}}</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="g-3">
                    {{--Pincel--}}
                    <div class="row rounded border mb-4">
                        <div class="bg-gray rounded-left">
                            <div class="m-3">
                                <div class="my-auto"><i class="fas fa-pencil-alt"></i></div>
                            </div>
                        </div>
                        <div class="col m-2">
                            <div class="border-bottom">
                                <h5 class="py-1 text-center">Horario</h5>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label class="col-form-label">
                                        {{ __('Nombre del horario') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="nombre_del_horario" class="form-control" wire:model="nombre_del_horario" placeholder="Ingrese el nombre del horario predeterminado">
                                    @error('nombre_del_horario') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label class="col-form-label">
                                    {{ __('Días laborales a la semana') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <div wire:ignore>
                                    <select class="w-100" id="days" name="days[]" multiple="multiple">
                                        <option>Lunes</option>
                                        <option>Martes</option>
                                        <option>Miércoles</option>
                                        <option>Jueves</option>
                                        <option>Viernes</option>
                                        <option>Sábado</option>
                                        <option>Domingo</option>
                                    </select>
                                </div>
                                @error('days') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            @if(count($days))
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table text-center border">
                                            <thead>
                                                <tr>
                                                    <th colspan="{{count($days)+1}}"><b>Horario</b></th>
                                                </tr>
                                                <tr>
                                                    <th class="bg-secondary"><i class="fa-solid fa-clock"></i></th>
                                                    @foreach ($days as $day)
                                                        <th class="border-left bg-secondary">{{$day}}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row" class="bg-light">Entrada</th>
                                                @foreach ($days as $n => $day)
                                                    <td class="border-left">
                                                        <input type="time" class="form-control border-0" id="entrada{{$day}}" required wire:model="hora_de_entrada.{{$n}}">
                                                        @error('hora_de_entrada.'.$n) <span class="text-danger error">{{ $message }}</span> @enderror
                                                    </td>
                                                @endforeach
                                            </tr>
                                                <tr>
                                                    <th scope="row" class="bg-light">Salida</th>
                                                    @foreach ($days as $n => $day)
                                                        <td class="border-left">
                                                            <input type="time" class="form-control border-0" id="salida{{$day}}" required wire:model="hora_de_salida.{{$n}}">
                                                            @error('hora_de_salida.'.$n) <span class="text-danger error">{{ $message }}</span> @enderror
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="text-center">
                <button type="button" wire:loading.attr="disabled" wire:click.prevent="save()" wire:target="save" class="btn btn-success">Guardar</button>
            </div>
        </div>
    </div>
</div>



@push('css')

    <link rel="stylesheet" href="/path/to/select2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

    <style>
    .select2 {
        width:100%!important;
    }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function () {
            $('#days').select2({
                theme: 'bootstrap4'
            });

            $('#days').on('change', function (e) {
                var data = $('#days').select2("val");
            @this.set('days', data);
            });
        });
    </script>
@endpush

