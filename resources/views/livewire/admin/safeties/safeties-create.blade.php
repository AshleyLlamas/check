<div class="py-4">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @can('admin.areas.index')
                <li class="breadcrumb-item"><a href="{{route('admin.areas.index')}}">Todas las incidencias</a></li>
            @endcan
            <li class="breadcrumb-item active">Nueva incidencia</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center my-2">{{$tipo}}</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="g-3">
                    {{--Pincel--}}
                    <div class="row rounded border">
                        <div class="bg-gray rounded-left">
                            <div class="m-3">
                                <div class="my-auto"><i class="fas fa-pencil-alt"></i></div>
                            </div>
                        </div>
                        <div class="col m-2">
                            <div class="border-bottom">
                                <h5 class="py-1 text-center">Incidencia</h5>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label class="col-form-label">
                                        {{ __('Tipo') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control" wire:model='tipo'>
                                        <option value="">Selecciona una opción</option>
                                        <option value="Fatalidad">Fatalidad</option>
                                        <option value="Primeros auxilios">Primeros auxilios</option>
                                        <option value="Accidentes de trabajo">Accidentes de trabajo</option>
                                        <option value="Incidentes a la propiedad">Incidentes a la propiedad</option>
                                        <option value="Incidentes ambientables">Incidentes ambientables</option>
                                    </select>
                                    @error('tipo') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12">
                                    <div wire:ignore>
                                        <label class="col-form-label">
                                            {{ __('Usuario') }}
                                            <small>(¿A quién le ocurrió?)</small>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" id="users">
                                            <option value="">Selecciona una opción</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id}}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('user') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12">
                                    <label class="col-form-label">
                                        {{ __('Fecha') }}
                                        <small>(¿Cuándo ocurrió?)</small>
                                    </label>
                                    <input type="date" id="fecha" class="form-control" wire:model="fecha" placeholder="Ingrese la fecha de nacimiento">
                                    @error('fecha') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12">
                                    <div wire:ignore>
                                        <label class="col-form-label">
                                            {{ __('Empresa / Compañia') }}
                                            <small>(¿Dónde ocurrió?)</small>
                                        </label>
                                        <select class="form-control" id="areas" wire:model="area">
                                            <option value="">Selecciona una opción</option>
                                            @foreach($areas as $area)
                                                <option value="{{ $area->id}}">{{ $area->área }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('area') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--FOTOS--}}
                    <div class="row rounded border pt-3">
                        <div class="bg-gray rounded-left">
                            <div class="m-3">
                                <div class="my-auto"><i class="fas fa-pencil-alt"></i></div>
                            </div>
                        </div>
                        <div class="col m-2">
                            <div class="border-bottom">
                                <h5 class="py-1 text-center">Evidencias</h5>
                            </div>
                            <div class="row pt-2">
                                @for ($i = 1; $i <= $n; $i++)
                                    <div class="form-group col-lg-4 col-12 col-md-6">
                                        <div class="border rounded">
                                            <div class="p-2">
                                                <input type="file" class="form-control-file" id="evidencia.{{$i}}" wire:model.defer="evidencia.{{$i}}">
                                                {{-- @if(isset($evidencia[$i]))
                                                    <img class="img-fluid rounded" style="display: block; margin-left: auto; margin-right: auto;" src="{{$evidencia[$i]->temporaryurl()}}">
                                                @endif --}}
                                                @error('evidencia.'.$i) <span class="text-danger error">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <div class="btn-group btn-group-toggle pt-2" data-toggle="buttons">
                                <label class="btn btn-secondary active">
                                  <input type="radio" name="options" id="option1" autocomplete="off" wire:click="add({{$n}})"> <i class="fa-solid fa-plus"></i>
                                </label>
                                <label class="btn btn-secondary">
                                  <input type="radio" name="options" id="option2" autocomplete="off" wire:click="remove({{$n}})"> <i class="fa-solid fa-minus"></i>
                                </label>
                            </div>
                            <div>
                                @error('n') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
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

            $('#asreas').select2({
                theme: 'bootstrap4'
            });

            $('#areas').on('change', function (e) {
                var data = $('#areas').select2("val");
            @this.set('area', data);
            });

            $('#users').select2({
                theme: 'bootstrap4'
            });

            $('#users').on('change', function (e) {
                var data = $('#users').select2("val");
            @this.set('user', data);
            });
        });
    </script>
@endpush
