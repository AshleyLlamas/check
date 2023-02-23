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

