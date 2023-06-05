<div class="py-4">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @can('admin.reclutas.index')
                <li class="breadcrumb-item"><a href="{{route('admin.reclutas.index')}}">Todos los reclutados</a></li>
            @endcan
            <li class="breadcrumb-item active">Nuevo reclutado</li>
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
                                <h5 class="py-1 text-center">Datos del reclutado</h5>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label class="col-form-label">
                                        {{ __('Nombre completo') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="name" class="form-control" wire:model="name" placeholder="Ingrese el nombre del empleado">
                                    @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
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
                                    <input type="text" id="número_de_inscripción_al_imss" class="form-control" wire:model="número_de_inscripción_al_imss" placeholder="Ingrese el número de inscripción al IMSS del empleado">
                                    @error('número_de_inscripción_al_imss') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label class="col-form-label">
                                        {{ __('RFC') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="rfc" class="form-control" wire:model="rfc" placeholder="Ingrese el RFC del empleado" oninput="this.value = this.value.toUpperCase()">
                                    @error('rfc') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12">
                                    <label class="col-form-label">
                                        {{ __('Número del infonavit') }}
                                    </label>
                                    <input type="text" id="número_del_infonavit" class="form-control" wire:model="número_del_infonavit" placeholder="Ingrese el número del infonavit del empleado">
                                    @error('número_del_infonavit') <span class="text-danger error">{{ $message }}</span>@enderror
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
                                <div class="form-group col-md-6">
                                    <label class="col-form-label">
                                        {{ __('Puesto') }}
                                    </label>
                                    <select class="form-control" id="puesto" wire:model="puesto">
                                        <option value="">Selecciona una opción</option>
                                        <option></option>
                                    </select>
                                    @error('puesto') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label class="col-form-label">
                                        {{ __('Tipo de puesto') }}
                                    </label>
                                    <select class="form-control" id="tipo_de_puesto" wire:model="tipo_de_puesto">
                                        <option value="">Selecciona una opción</option>
                                        <option>Directiva</option>
                                        <option>Gerencial</option>
                                        <option>Coordinación</option>
                                        <option>Jefatura</option>
                                        <option>Sub jefatura</option>
                                        <option>Administrativa</option>
                                        <option>Operativa</option>
                                        <option>Residencia de obra</option>
                                        <option>Superintendencia</option>
                                        <option>Temporal</option>
                                        <option>Productivo</option>
                                    </select>
                                    @error('tipo_de_puesto') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12">
                                    <div>
                                        <label class="col-form-label">
                                            {{ __('Estatus') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" id="tipo" wire:model="tipo">
                                            <option value="">Selecciona una opción</option>
                                            <option>Reclutado</option>
                                            <option>Prospecto</option>
                                            <option>Por contratar</option>
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
                                        <select class="form-control" id="companies">
                                            <option value="">Selecciona una opción</option>
                                            @foreach($companies as $company)
                                                <option value="{{ $company->id}}">{{ $company->nombre_de_la_compañia }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('company') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12">
                                    <div wire:ignore>
                                        <label class="col-form-label">
                                            {{ __('Área / Proyecto') }}
                                        </label>
                                        <select class="form-control" id="área" wire:model="área">
                                            <option value="">Selecciona una opción</option>
                                            @foreach($areas as $area)
                                                <option value="{{ $area->id}}">{{ $area->área }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('área') <span class="text-danger error">{{ $message }}</span>@enderror
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
                                            <option>Miercoles</option>
                                            <option>Jueves</option>
                                            <option>Viernes</option>
                                            <option>Sabado</option>
                                            <option>Domingo</option>
                                        </select>
                                    </div>
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
                    {{--Documentos--}}
                    <div class="row rounded border">
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
            $('#companies').select2({
                theme: 'bootstrap4'
            });

            $('#companies').on('change', function (e) {
                var data = $('#companies').select2("val");
            @this.set('company', data);
            });
            /////

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
