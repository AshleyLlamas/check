<div class="form-group col-12 col-md-4">
    <label class="col-form-label">
        {{ __('Marca') }}
        <span class="text-danger">*</span>
    </label>
    <input type="text" id="marca" class="form-control" wire:model="marca" placeholder="Ingrese la marca">
    @error('marca') <span class="text-danger error">{{ $message }}</span>@enderror
</div>

<div class="form-group col-12 col-md-4">
    <label class="col-form-label">
        {{ __('Modelo') }}
        <span class="text-danger">*</span>
    </label>
    <input type="text" id="modelo" class="form-control" wire:model="modelo" placeholder="Ingrese el modelo">
    @error('modelo') <span class="text-danger error">{{ $message }}</span>@enderror
</div>


<div class="form-group col-12 col-md-4">
    <label class="col-form-label">
        {{ __('Serie') }}
        <span class="text-danger">*</span>
    </label>
    <input type="text" id="serie" class="form-control" wire:model="serie" placeholder="Ingrese la serie">
    @error('serie') <span class="text-danger error">{{ $message }}</span>@enderror
</div>


<div class="form-group col-12">
    <div wire:ignore>
        <label class="col-form-label">
            {{ __('Compañia / Empresa') }}
            <span class="text-danger">*</span>
        </label>
        <select class="form-control" id="companies" wire:model=company>
            <option value="">Selecciona una opción</option>
            @foreach($companies as $company)
                <option value="{{ $company->id}}">{{ $company->nombre_de_la_compañia }}</option>
            @endforeach
        </select>
    </div>
    @error('company') <span class="text-danger error">{{ $message }}</span>@enderror
</div>
