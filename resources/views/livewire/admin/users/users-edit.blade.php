<div class="py-4">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @can('admin.users.index')
                <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">Todos los empleados</a></li>
            @endcan
            <li class="breadcrumb-item active">Nuevo empleado</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center my-2">{{$name}}</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="g-3">
                    {{--Foto--}}
                    <div class="row rounded border  mb-3">
                        <div class="bg-gray rounded-left">
                            <div class="m-3">
                                <div class="my-auto"><i class="fas fa-image"></i></div>
                            </div>
                        </div>
                        <div class="col m-2">
                            <div class="border-bottom">
                                <h5 class="py-1 text-center">Foto</h5>
                            </div>
                            <div class="custom-file mt-3 pt-3">
                                <input type="file" class="custom-file-input" lang="es" wire:model="foto" accept="image/*">
                                <label class="custom-file-label" for="customFileLang">Selecciona una foto</label>
                                @error('foto') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                {{-- <div wire:target="foto" wire:loading>
                                    <button class="btn btn-white mt-3" type="button" disabled>
                                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                        Cargando...
                                    </button>
                                </div> --}}
                                <div class="pt-3">
                                    @if($foto)
                                        <img class="img-fluid rounded" style="display: block; margin-left: auto; margin-right: auto;" src="{{$foto->temporaryurl()}}">
                                    @else
                                        @isset($user->image)
                                            <img class="img-fluid rounded" style="display: block; margin-left: auto; margin-right: auto;" src="{{Storage::url($user->image->url)}}">
                                        @endisset
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Pincel--}}
                    <div class="row rounded border mb-4">
                        <div class="bg-gray rounded-left">
                            <div class="m-3">
                                <div class="my-auto"><i class="fas fa-pencil-alt"></i></div>
                            </div>
                        </div>
                        <div class="col m-2">
                            <div class="border-bottom">
                                <h5 class="py-1 text-center">Datos del empleado</h5>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label class="col-form-label">
                                        {{ __('Nombre completo') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="name" class="form-control" wire:model="user.name" placeholder="Ingrese el nombre del empleado">
                                    @error('user.name') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                
                                <div class="form-group col-12">
                                    <label class="col-form-label">
                                        {{ __('Correo') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="correo" class="form-control" wire:model="email" placeholder="Ingrese el correo del empleado">
                                    @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12">
                                    <label class="col-form-label">
                                        {{ __('CURP') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="curp" class="form-control" wire:model="curp" placeholder="Ingrese el CURP del empleado" oninput="this.value = this.value.toUpperCase()">
                                    @error('curp') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label class="col-form-label">
                                        {{ __('Número de inscripción al IMSS') }}
                                    </label>
                                    <input type="text" id="número_de_inscripción_al_imss" class="form-control" wire:model="user.número_de_inscripción_al_imss" placeholder="Ingrese el número de inscripción al IMSS del empleado">
                                    @error('user.número_de_inscripción_al_imss') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label class="col-form-label">
                                        {{ __('RFC') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="rfc" class="form-control" wire:model="user.rfc" placeholder="Ingrese el RFC del empleado" oninput="this.value = this.value.toUpperCase()">
                                    @error('user.rfc') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12">
                                    <label class="col-form-label">
                                        {{ __('Número del infonavit') }}
                                    </label>
                                    <input type="text" id="número_del_infonavit" class="form-control" wire:model="user.número_del_infonavit" placeholder="Ingrese el número del infonavit del empleado">
                                    @error('user.número_del_infonavit') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Trabajo--}}
                    <div class="row rounded border mb-4">
                        <div class="bg-gray rounded-left">
                            <div class="m-3">
                                <div class="my-auto"><i class="fa-solid fa-briefcase"></i></div>
                            </div>
                        </div>
                        <div class="col m-2">
                            <div class="border-bottom">
                                <h5 class="py-1 text-center">Datos del trabajo</h5>
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-md-6">
                                    <label class="col-form-label">
                                        {{ __('Número de empleado') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" id="número_de_empleado" class="form-control" wire:model="user.número_de_empleado" placeholder="Ingrese el número de empleado">
                                    @error('user.número_de_empleado') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label class="col-form-label">
                                        {{ __('Puesto') }}
                                    </label>
                                    <input type="text" id="puesto" class="form-control" wire:model="user.puesto" placeholder="Ingrese el puesto del empleado">
                                    @error('user.puesto') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12">
                                    <div>
                                        <label class="col-form-label">
                                            {{ __('Tipo de empleado') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" id="tipo" wire:model="tipo">
                                            <option value="">Selecciona una opción</option>
                                            <option>Empleado</option>
                                            <option>Recluta</option>
                                        </select>
                                    </div>
                                    @error('tipo') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12">
                                    <div wire:ignore>
                                        <label class="col-form-label">
                                            {{ __('Empresa / Compañia') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" id="companies" wire:model="company">
                                            <option value="">Selecciona una opción</option>
                                            @foreach($companies as $company)
                                                <option value="{{ $company->id}}">{{ $company->nombre_de_la_compañia }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('company') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Documentos--}}
                    <div class="row rounded border mb-4">
                        <div class="bg-gray rounded-left">
                            <div class="m-3">
                                <div class="my-auto"><i class="fa-solid fa-folder"></i></div>
                            </div>
                        </div>
                        <div class="col m-2">
                            <div class="border-bottom">
                                <h5 class="py-1 text-center">Documentos</h5>
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-sm-6 col-md-4 col-xl-3">
                                    <label class="col-form-label">
                                        {{ __('Identificación oficial / INE') }}
                                        {{-- <span class="text-danger">*</span> --}}
                                    </label>
                                    <input type="file" class="form-control-file" id="documento_de_identificación_oficial" wire:model.defer="documento_de_identificación_oficial">
                                    @error('documento_de_identificación_oficial') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12 col-sm-6 col-md-4 col-xl-3">
                                    <label class="col-form-label">
                                        {{ __('Comprobante de domicilio') }}
                                        {{-- <span class="text-danger">*</span> --}}
                                    </label>
                                    <input type="file" class="form-control-file" id="documento_del_comprobante_de_domicilio" wire:model.defer="documento_del_comprobante_de_domicilio">
                                    @error('documento_del_comprobante_de_domicilio') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12 col-sm-6 col-md-4 col-xl-3">
                                    <label class="col-form-label">
                                        {{ __('No atecendentes penales') }}
                                        {{-- <span class="text-danger">*</span> --}}
                                    </label>
                                    <input type="file" class="form-control-file" id="documento_de_no_antecedentes_penales" wire:model.defer="documento_de_no_antecedentes_penales">
                                    @error('documento_de_no_antecedentes_penales') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12 col-sm-6 col-md-4 col-xl-3">
                                    <label class="col-form-label">
                                        {{ __('Licencia de conducir') }}
                                    </label>
                                    <input type="file" class="form-control-file" id="documento_de_la_licencia_de_conducir" wire:model.defer="documento_de_la_licencia_de_conducir">
                                    @error('documento_de_la_licencia_de_conducir') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12 col-sm-6 col-md-4 col-xl-3">
                                    <label class="col-form-label">
                                        {{ __('Cedula profesional') }}
                                    </label>
                                    <input type="file" class="form-control-file" id="documento_de_la_cedula_profesional" wire:model.defer="documento_de_la_cedula_profesional">
                                    @error('documento_de_la_cedula_profesional') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12 col-sm-6 col-md-4 col-xl-3">
                                    <label class="col-form-label">
                                        {{ __('Carta de pasante') }}
                                    </label>
                                    <input type="file" class="form-control-file" id="documento_de_la_carta_de_pasante" wire:model.defer="documento_de_la_carta_de_pasante">
                                    @error('documento_de_la_carta_de_pasante') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12 col-sm-6 col-md-4 col-xl-3">
                                    <label class="col-form-label">
                                        {{ __('Curriculum Vitae (CV)') }}
                                        {{-- <span class="text-danger">*</span> --}}
                                    </label>
                                    <input type="file" class="form-control-file" id="documento_del_curriculum_vitae" wire:model.defer="documento_del_curriculum_vitae">
                                    @error('documento_del_curriculum_vitae') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Rol--}}
                    <div class="row rounded border">
                        <div class="bg-gray rounded-left">
                            <div class="m-3">
                                <div class="my-auto"><i class="fa-solid fa-unlock"></i></div>
                            </div>
                        </div>
                        <div class="col m-2">
                            <div class="border-bottom">
                                <h5 class="py-1 text-center">Rol</h5>
                            </div>
                            <div>
                                <div class="form-group">
                                    <label class="col-form-label">
                                        {{ __('Rol') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control" aria-label="Default select example" wire:model="role">
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('role') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="text-center">
                <button type="button" wire:loading.attr="disabled" wire:click.prevent="save()" wire:target="save, fotodocumento_de_identificación_oficial, documento_del_comprobante_de_domicilio, documento_de_no_antecedentes_penales, documento_de_la_licencia_de_conducir, documento_de_la_cedula_profesional, documento_de_la_carta_de_pasante, documento_del_curriculum_vitae" class="btn btn-success">Guardar</button>
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
            $('#companies').select2();

            $('#companies').on('change', function (e) {
                var data = $('#companies').select2("val");
            @this.set('company', data);
            });
            /////

            $('#days').select2();

            $('#days').on('change', function (e) {
                var data = $('#days').select2("val");
            @this.set('days', data);
            });
        });
    </script>
@endpush