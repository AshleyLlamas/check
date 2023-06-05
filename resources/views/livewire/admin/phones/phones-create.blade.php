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

                                <div class="form-group col-12">
                                    <div wire:ignore>
                                        <label class="col-form-label">
                                            {{ __('Tipo') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" wire:model="tipo">
                                            <option value="">Selecciona una opción</option>
                                            <option value="Celular">Celular</option>
                                            <option value="Fijo">Fijo</option>
                                        </select>
                                    </div>
                                    @error('tipo') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12">
                                    <div wire:ignore>
                                        <label class="col-form-label">
                                            {{ __('Sistema Operativo') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" wire:model="sistema_operativo">
                                            <option value="">Selecciona una opción</option>
                                            <option value="Android">Android</option>
                                            <option value="iOS">iOS</option>
                                            <option value="Windows 10 Mobile">Windows 10 Mobile</option>
                                            <option value="Symbian OS">Symbian OS</option>
                                            <option value="Firefox OS">Firefox OS</option>
                                            <option value="Ubuntu Touch">Ubuntu Touch</option>
                                            <option value="Harmony OS">Harmony OS</option>
                                        </select>
                                    </div>
                                    @error('sistema_operativo') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label class="col-form-label">
                                        {{ __('Plan') }}
                                    </label>
                                    <input type="text" id="plan" class="form-control" wire:model="plan" placeholder="Ingrese el plan">
                                    @error('plan') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label class="col-form-label">
                                        {{ __('Número celular o extención') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="número_celular_o_extención" class="form-control" wire:model="número_celular_o_extención" placeholder="Ingrese el número celular o extención">
                                    @error('número_celular_o_extención') <span class="text-danger error">{{ $message }}</span>@enderror
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

