<div class="py-4">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @can('admin.administrative_records.index')
                <li class="breadcrumb-item"><a href="{{route('admin.administrative_records.index')}}">Todas las actas administrativas</a></li>
            @endcan
            <li class="breadcrumb-item active">Editar acta administrativa</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center my-2">Acta administrativa</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="g-3">
                    {{--colaborador--}}
                    <div class="row rounded border mb-4">
                        <div class="bg-gray rounded-left">
                            <div class="m-3">
                                <i class="fa-solid fa-user"></i>
                            </div>
                        </div>
                        <div class="col m-2">
                            <div class="border-bottom">
                                <h5 class="py-1 text-center">Colaborador</h5>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <div wire:ignore>
                                        <label class="col-form-label">
                                            {{ __('Colaborador') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" id="users" wire:model="colaborador">
                                            <option value="">Selecciona una opción</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id}}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('colaborador') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12">
                                    <label class="col-form-label">
                                        {{ __('Comentarios del colaborador') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" lang="es" wire:model="comentarios_del_colaborador" accept="image/*">
                                        <label class="custom-file-label" for="customFileLang">Selecciona una imagen</label>
                                        @error('comentarios_del_colaborador') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                    <div>
                                        {{-- <div wire:loading wire:target="comentarios_del_colaborador">
                                            <button class="btn btn-white mt-3" type="button" disabled>
                                                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                                Cargando...
                                            </button>
                                        </div> --}}
                                        <div class="pt-3">
                                            @if($comentarios_del_colaborador)
                                                <img class="img-fluid rounded" style="display: block; margin-left: auto; margin-right: auto;" src="{{$comentarios_del_colaborador->temporaryurl()}}">
                                            @else
                                                @isset($administrative_record->comentarios_del_colaborador)
                                                    <img class="img-fluid rounded" style="display: block; margin-left: auto; margin-right: auto;" src="{{Storage::url($administrative_record->comentarios_del_colaborador)}}">
                                                @endisset
                                            @endif
                                        </div>
                                    </div>
                                    @error('comentarios_del_colaborador') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- pen --}}
                    <div class="row rounded border">
                        <div class="bg-gray rounded-left">
                            <div class="m-3">
                                <i class="fa-solid fa-pen"></i>
                            </div>
                        </div>
                        <div class="col m-2">
                            <div class="row">
                                <p class="p-2 mt-2 border rounded small bg-warning">La presente <span class="text-danger">amonestación</span> se efectúa por una violación por parte del trabajador tanto al artículo 47 de la LFT así como al reglamento interno de la Compañía, por lo que de tratarse de una falta de tal magnitud que impida la relación laboral entre el trabajador y la empresa, se procederá sin prejuicio para la misma conforme a las fracciones contenidas tanto en el art. 47 de la LFT como del reglamento interno.</p>
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
                                <div class="form-group col-12">
                                    <div>
                                        <label class="col-form-label">
                                            {{ __('Categoria del permiso') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" id="categoria_del_permiso" wire:model="categoria_del_permiso">
                                            <option value="">Selecciona una opción</option>
                                            <option value="Día de ausencia">Día de ausencia</option>
                                            <option value="Fecha de suspención">Fecha de suspención</option>
                                        </select>
                                    </div>
                                    @error('categoria_del_permiso') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12">
                                    <label class="col-form-label">
                                        {{ __('Fecha del permiso') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        @if(isset($categoria_del_permiso) && $categoria_del_permiso != '')
                                            <div class="input-group-prepend">
                                                <label class="input-group-text">{{$categoria_del_permiso}}</label>
                                            </div>
                                        @endif
                                        <input type="date" id="fecha_del_permiso" name="fecha_del_permiso" class="form-control" wire:model="fecha_del_permiso">
                                    </div>
                                    @error('fecha_del_permiso') <span class="text-danger error">{{ $message }}</span>@enderror
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

        $(document).ready(function () {

            $('#users').select2({
                theme: 'bootstrap4'
            });

            $('#users').on('change', function (e) {
                var data = $('#users').select2("val");
            @this.set('colaborador', data);
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
