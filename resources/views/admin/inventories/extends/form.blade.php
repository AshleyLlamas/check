@switch($ordenante)
    @case('usuario')
        <select class="custom-select" id="supplier" wire:model="supplier">
            <option value="">Selecciona una opción</option>
            @foreach ($suppliers as $supplier)
                <option value="{{$supplier->id}}">{{$supplier->nombre}}</option>
            @endforeach
        </select>
        @error('supplier') <span class="text-danger error">{{ $message }}</span>@enderror
    @break
    @case('area')
        <select class="custom-select" id="ordenante_cellar" wire:model="ordenante_cellar">
            <option value="">Selecciona una opción</option>
            @foreach ($cellars as $cellar)
                <option value="{{$cellar->id}}">{{$cellar->nombre}}</option>
            @endforeach
        </select>
        @error('ordenante_cellar') <span class="text-danger error">{{ $message }}</span>@enderror
    @break
@endswitch

<div class="form-group col-6">
    <div>
        <label class="col-form-label">
            {{ __('Propietario') }}
            <span class="text-danger">*</span>
        </label>
        {{-- <div class="btn-group btn-group-toggle" data-toggle="buttons" wire:model="ordenante">
            <label class="btn btn-light btn-sm @if($ordenante == null) active  @endif">
                <input type="radio" name="options" id="na" value="" autocomplete="off"> Sin propietario
            </label>
            <label class="btn btn-light btn-sm @if($ordenante == 'Usuario') active  @endif">
                <input type="radio" name="options" id="usuario" value="Usuario" autocomplete="off"> Usuario
            </label>
            <label class="btn btn-sm btn-light @if($ordenante == 'Área') active  @endif">
                <input type="radio" name="options" id="area" value="Área" autocomplete="off"> Área (comunitario)
            </label>
        </div> --}}
        {{-- @switch($ordenante)
            @case('Usuario')
                <select class="form-control" id="users" wire:model=propietario>
                    <option value="">Selecciona una opción</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id}}">{{ $user->name }}</option>
                    @endforeach
                </select>
            @break
            @case('Área')
                <select class="form-control" id="areas" wire:model=propietario>
                    <option value="">Selecciona una opción</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->id}}">{{ $area->área }}</option>
                    @endforeach
                </select>
            @break
        @endswitch --}}
        <select class="form-control" id="users" wire:model=propietario>
            <option value="">Sin propietario</option>

            <optgroup label="Usuarios">
                @foreach($users as $user)
                    <option value="A{{ $user->id}}">{{ $user->name }}</option>
                @endforeach
            </optgroup>
            <optgroup label="Áreas o proyectos">
                @foreach($areas as $area)
                    <option value="B{{ $area->id}}">{{ $area->área }}</option>
                @endforeach
            </optgroup>
        </select>
    </div>
    @error('ordenante') <span class="text-danger error">{{ $message }}</span>@enderror
</div>

<div class="form-group col-12 col-md-6">
    <div wire:ignore>
        <label class="col-form-label">
            {{ __('Arrendado') }}
            <span class="text-danger">*</span>
        </label>
        <select class="form-control" wire:model="arrendado">
            <option value="No">No</option>
            <option value="Si">Si</option>
        </select>
    </div>
    @error('arrendado') <span class="text-danger error">{{ $message }}</span>@enderror
</div>

<div class="col-12 col-md-6 px-3 pt-3">
    <div class="form-group border rounded  p-3">
        <div class="custom-file">
            <label class="col-form-label">
                {{ __('Garantía') }}
            </label>
            <input type="file" class="form-control-file" lang="es" wire:model="garantía">
            @error('garantía') <span class="text-danger error">{{ $message }}</span>@enderror
        </div>
        {{-- <div class="pt-3">
            @if($garantía)
                <img class="img-fluid rounded" style="display: block; margin-left: auto; margin-right: auto;" src="{{$garantía->temporaryurl()}}">
            @else
                @isset($inventory->garantia)
                    <img class="img-fluid rounded" style="display: block; margin-left: auto; margin-right: auto;" src="{{Storage::url($inventory->garantia)}}">
                @endisset
            @endif
        </div> --}}
    </div>
</div>

<div class="col-12 col-md-6 px-3 pt-3">
    <div class="form-group border rounded p-3">
        <div class="custom-file">
            <label class="col-form-label">
                {{ __('Factura') }}
            </label>
            <input type="file" class="form-control-file" lang="es" wire:model="factura">
            @error('factura') <span class="text-danger error">{{ $message }}</span>@enderror
        </div>
        {{-- <div class="pt-3">
            @if($factura)
                <img class="img-fluid rounded" style="display: block; margin-left: auto; margin-right: auto;" src="{{$factura->temporaryurl()}}">
            @else
                @isset($inventory->factura)
                    <img class="img-fluid rounded" style="display: block; margin-left: auto; margin-right: auto;" src="{{Storage::url($inventory->factura)}}">
                @endisset
            @endif
        </div> --}}
    </div>
</div>

<div class="form-group col-12">
    <label class="col-form-label">
        {{ __('Fecha de adquisición') }}
    </label>
    <input type="date" id="fecha_de_adquisición" qr="fecha_de_adquisición" class="form-control" wire:model="fecha_de_adquisición">
    @error('fecha_de_adquisición') <span class="text-danger error">{{ $message }}</span>@enderror
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

<div class="form-group col-12">
    <label class="col-form-label">
        {{ __('QR') }}
        <span class="text-danger">*</span>
    </label>
    <input type="text" id="qr" class="form-control" wire:model="qr">
    @error('qr') <span class="text-danger error">{{ $message }}</span>@enderror
</div>
