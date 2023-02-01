<div class="py-4">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @can('admin.admonitions.index')
                <li class="breadcrumb-item"><a href="{{route('admin.admonitions.index')}}">Todas las amonestaciones</a></li>
            @endcan
            <li class="breadcrumb-item active">Nueva amonestación</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center my-2">Amonestación</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="g-3">
                    {{--colaborador--}}
                    <div class="row rounded border">
                        <div class="bg-gray rounded-left">
                            <div class="m-3">
                                <i class="fa-solid fa-user"></i>
                            </div>
                        </div>
                        <div class="col m-2">
                            <div class="row">
                                <div class="form-group col-12">
                                    <div wire:ignore>
                                        <label class="col-form-label">
                                            {{ __('Amonestado') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" id="amonestados" wire:model="amonestado">
                                            <option value="">Selecciona una opción</option>
                                            @foreach($amonestados as $amonestado)
                                                <option value="{{ $amonestado->id}}">{{ $amonestado->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('amonestado') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12">
                                    <div wire:ignore>
                                        <label class="col-form-label">
                                            {{ __('Solicitante') }}
                                            <span class="text-danger">* <small>(Solicitado por)</small></span>
                                        </label>
                                        <select class="form-control" id="solicitantes" wire:model="solicitante">
                                            <option value="">Selecciona una opción</option>
                                            @foreach($solicitantes as $solicitante)
                                                <option value="{{ $solicitante->id}}">{{ $solicitante->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('solicitante') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12">
                                    <div>
                                        <label class="col-form-label">
                                            {{ __('Gravedad') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" wire:model="gravedad">
                                            <option value="">Selecciona una opción</option>
                                            <option value="Leve">Leve</option>
                                            <option value="Moderado">Moderado</option>
                                            <option value="Grave">Grave</option>
                                            <option value="Muy grave">Muy grave</option>
                                        </select>
                                    </div>
                                    @error('gravedad') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12">
                                    <label class="col-form-label">
                                        {{ __('Fecha de la insidencia') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" id="fecha_de_la_incidencia" name="fecha_de_la_incidencia" class="form-control" wire:model="fecha_de_la_incidencia">
                                    @error('fecha_de_la_incidencia') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12">
                                    <div>
                                        <label class="col-form-label">
                                            {{ __('Tipo de amonestación') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" wire:model="admonition_type">
                                            <option value="">Selecciona una opción</option>
                                            @foreach($admonition_types as $admonition_type)
                                                <option value="{{ $admonition_type->id}}">{{ $admonition_type->tipo}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('admonition_type') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12" wire:ignore>
                                    <label class="col-form-label">
                                        {{ __('Observaciones') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <form method="post" wire:model="observaciones">
                                        <textarea id="observaciones" name="observaciones">{{$observaciones}}</textarea>
                                    </form>
                                </div>
                                @error('observaciones') <span class="text-danger error">{{ $message }}</span>@enderror
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

@push('js')

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>

        $('#observaciones').summernote({
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
                    @this.set('observaciones', contents);
                }
            }
        });

        $('#observaciones').summernote({
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
                    @this.set('observaciones', contents);
                }
            }
        });

        $(document).ready(function () {

            $('#solicitantes').select2();

            $('#solicitantes').on('change', function (e) {
                var data = $('#solicitantes').select2("val");
            @this.set('solicitante', data);
            });

            $('#amonestados').select2();

            $('#amonestados').on('change', function (e) {
                var data = $('#amonestados').select2("val");
            @this.set('amonestado', data);
            });

            $('#admonition_types').select2();

            $('#admonition_types').on('change', function (e) {
                var data = $('#admonition_types').select2("val");
            @this.set('admonition_type', data);
            });
        });
    </script>
@endpush

@push('css')
    <style>
    .select2 {
        width:100%!important;
    }
    </style>
@endpush