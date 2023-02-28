<div class="py-4">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @can('admin.calendars.index')
                <li class="breadcrumb-item"><a href="{{route('admin.calendars.index')}}">Calendario - Todos los días no laborales</a></li>
            @endcan
            <li class="breadcrumb-item active">Editar día no laboral</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center my-2">{{$nonWorkingDay->razón}}</h5>
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
                                <h5 class="py-1 text-center">Registrar día no laboral</h5>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label class="col-form-label">
                                        {{ __('Razón') }} <small>(Nombre del día festivo)</small>
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="razón" class="form-control" wire:model="nonWorkingDay.razón" placeholder="Ingrese la razón por el cual no se labora">
                                    @error('nonWorkingDay.razón') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12">
                                    <label class="col-form-label">
                                        {{ __('Fecha') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" id="fecha" class="form-control" wire:model="fecha">
                                    @error('fecha') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Configuración --}}
                    <div class="row rounded border">
                        <div class="bg-gray rounded-left">
                            <div class="m-3">
                                <div class="my-auto"><i class="fas fa-cog"></i></div>
                            </div>
                        </div>
                        <div class="col m-2">
                            <div class="border-bottom">
                                <h5 class="py-1 text-center">Configuración de calculo</h5>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <div>
                                        <label class="col-form-label">
                                            {{ __('Sueldo en caso de no trabajar el día') }}
                                        </label>
                                        <select class="form-control" id="sueldo" wire:model="sueldo">
                                            <option value="Sin gose">Sin gose de sueldo</option>
                                            <option value="Con gose">Con gose de sueldo</option>
                                        </select>
                                    </div>
                                    @error('sueldo') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12">
                                    <div>
                                        <label class="col-form-label">
                                            {{ __('multiplicador de sueldo en caso de trabajar el día') }}
                                        </label>
                                        <select class="form-control" id="multiplicador" wire:model="multiplicador">
                                            <option value="1">(Sueldo) x 1</option>
                                            <option value="2">(Sueldo) x 2</option>
                                            <option value="3">(Sueldo) x 3</option>
                                        </select>
                                    </div>
                                    @error('multiplicador') <span class="text-danger error">{{ $message }}</span>@enderror
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
