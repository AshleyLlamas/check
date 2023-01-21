<div>
    <div wire:model="aprobación">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Aprobado">
            <label class="form-check-label" for="inlineRadio1">Aprobado</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="No aprobado">
            <label class="form-check-label" for="inlineRadio2">No aprobado</label>
        </div>
        @error('aprobación') <span class="text-danger error">{{ $message }}</span>@enderror
    </div>
    <div class="form-group" wire:ignore>
        <label for="observaciones" class="col-form-label">{{ __('Observaciones') }}</label>
        <input type="text" id="observaciones" name="observaciones" class="form-control" wire:model="observaciones" placeholder="Ingrese la observaciones">
    </div>
    @error('observaciones') <span class="text-danger error">{{ $message }}</span>@enderror

    <div class="text-center">
        <button type="submit" class="btn btn-sm btn-success">Guardar</button>
    </div>
</div>