<div class="py-4">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @can('admin.areas.index')
                <li class="breadcrumb-item"><a href="{{route('admin.areas.index')}}">Todas las incidencias</a></li>
            @endcan
            <li class="breadcrumb-item active">Editar incidencia</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center my-2">{{$safety->tipo}}</h5>
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
                                        <option value="No hubo incidencias">No hubo incidencias</option>
                                    </select>
                                    @error('tipo') <span class="text-danger error">{{ $message }}</span>@enderror
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
                                            {{ __('Área / Proyecto') }}
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
                                <div class="col-12 form-group" wire:ignore>
                                    <div>
                                        <label class="col-form-label">
                                            {{ __('Usuarios') }}
                                            <small>(Afectados)</small>
                                        </label>
                                        <select id="users-dropdown" multiple style="width: 100%;" wire:model="afectados">
                                            @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('afectados') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12">
                                    <div wire:ignore>
                                        <label class="col-form-label">
                                            {{ __('Descripción') }}
                                        </label>
                                        {{-- <input type="text" id="descripción" class="form-control" wire:model="descripción" placeholder="Ingrese la descripción"> --}}
                                        <textarea class="form-control" wire:model="descripción" id="descripción" rows="3">{!! $descripción !!}</textarea>
                                    </div>
                                    @error('descripción') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

    <style>
    .select2 {
        width:100%!important;
    }
    </style>
@endpush


@push('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
         $('#descripción').summernote({
            tabsize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('descripción', contents);
                }
            }
        });

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

            $(document).ready(function () {
            $('#users-dropdown').select2({
                theme: "classic"
            });

            $("#checkbox").click();
                $('#users-dropdown').on('change', function (e) {
                    let data = $(this).val();
                    @this.set('afectados', data);
                });
            });
        });
    </script>
@endpush
