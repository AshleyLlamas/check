<div class="py-4">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @can('admin.devices.index')
                <li class="breadcrumb-item"><a href="{{route('admin.devices.index')}}">Todos los dispositivos</a></li>
            @endcan
            <li class="breadcrumb-item active">Nuevo dispositivo</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center my-2">{{$name}}</h5>
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
                                <h5 class="py-1 text-center">Dispositivo</h5>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label class="col-form-label">
                                        {{ __('Nombre') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="name" class="form-control" wire:model="name" placeholder="Ingrese el nombre">
                                    @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12">
                                    <label class="col-form-label">
                                        {{ __('Correo') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="correo" class="form-control" wire:model="email" placeholder="Ingrese el correo">
                                    @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12">
                                    <div wire:ignore>
                                        <label class="col-form-label">
                                            {{ __('Encargado') }}
                                        </label>
                                        <select class="form-control" id="users" wire:model="encargado">
                                            <option value="">Selecciona una opción</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id}}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('encargado') <span class="text-danger error">{{ $message }}</span>@enderror
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
                                <div class="form-group col-12 col-md-6 col-sm-6">
                                    <label class="col-form-label">
                                        {{ __('Contraseña') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" class="form-control" wire:model="password" required autocomplete="new-password" placeholder="Ingrese la contraseña del dispositivo">
                                    @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12 col-md-6 col-sm-6">
                                    <label class="col-form-label">
                                        {{ __('Confirmar contraseña') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" class="form-control" wire:model="password_confirmation" required autocomplete="new-password" placeholder="Nuevamente ingrese la contraseña del dispositivo">
                                    @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--User --}}
                    <div class="row rounded border">
                        <div class="bg-gray rounded-left">
                            <div class="m-3">
                                <div class="my-auto"><i class="fa fa-users" aria-hidden="true"></i></div>
                            </div>
                        </div>
                        <div class="col m-2">
                            <div class="border-bottom">
                                <h5 class="py-1 text-center">Agregar usuarios al dispositivo</h5>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group pt-3" wire:ignore>
                                    <div>
                                        <select id="users-dropdown" multiple style="width: 100%;" wire:model="usersInDevice">
                                            @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="checkbox"> Seleccionar a todos
                                    </div>
                                    @error('usersInDevice') <span class="text-danger error">{{ $message }}</span>@enderror
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
            @this.set('encargado', data);
            });
        });

        $(document).ready(function () {
            $('#users-dropdown').select2({
                theme: "classic"
            });

            //Seleccionar a todos
            $("#checkbox").click(function(){
                if($("#checkbox").is(':checked') ){
                    $("#users-dropdown > option").prop("selected","selected");
                    $("#users-dropdown").trigger("change");
                }else{
                    $("#users-dropdown > option").prop("selected", false);
                    $("#users-dropdown").trigger("change");
                }
            });
            $('#users-dropdown').on('change', function (e) {
                let data = $(this).val();
                @this.set('usersInDevice', data);
            });
        });

    </script>
@endpush
