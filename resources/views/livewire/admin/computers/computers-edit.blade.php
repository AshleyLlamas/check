<div class="py-4">
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
                                <h5 class="py-1 text-center">Datos</h5>
                            </div>
                            <div class="row">

                                @include('admin.electronics.extends.form')

                                <div class="form-group col-12 col-md-4">
                                    <label class="col-form-label">
                                        {{ __('RAM') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" id="ram" class="form-control" wire:model="computer.ram" placeholder="Ingrese los gigabytes de RAM">
                                    @error('computer.ram') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>

                                <div class="form-group col-12 col-md-4">
                                    <label class="col-form-label">
                                        {{ __('Procesador') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="procesador" class="form-control" wire:model="computer.procesador" placeholder="Ingrese el procesador">
                                    @error('computer.procesador') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>

                                <div class="form-group col-12 col-md-4">
                                    <label class="col-form-label">
                                        {{ __('Targeta gráfica') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="targeta_gráfica" class="form-control" wire:model="computer.targeta_gráfica" placeholder="Ingrese la targeta grafica">
                                    @error('computer.targeta_gráfica') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>

                                <div class="form-group col-12 col-md-6">
                                    <label class="col-form-label">
                                        {{ __('Sistema operativo') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="sistema_operativo" class="form-control" wire:model="computer.sistema_operativo" placeholder="Ingrese el sistema operativo">
                                    @error('computer.sistema_operativo') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>

                                <div class="form-group col-12 col-md-6">
                                    <div wire:ignore>
                                        <label class="col-form-label">
                                            {{ __('Tipo') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" wire:model="computer.tipo">
                                            <option value="">Selecciona una opción</option>
                                            <option value="Desktop">Desktop</option>
                                            <option value="Laptop">Laptop</option>
                                        </select>
                                    </div>
                                    @error('computer.tipo') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>

                                @include('admin.inventories.extends.form')

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
    <style>
    .select2 {
        width:100%!important;
    }
    </style>
@endpush


@push('js')
    <script>
        $(document).ready(function () {

            $('#users').select2();

            $('#users').on('change', function (e) {
                var data = $('#users').select2("val");
            @this.set('propietario', data);
            });
        });
    </script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
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
            @this.set('propietario', data);
            });

            $('#companies').select2({
                theme: 'bootstrap4'
            });

            $('#companies').on('change', function (e) {
                var data = $('#companies').select2("val");
                @this.set('company', data);
            });
        });
    </script>

@endpush

