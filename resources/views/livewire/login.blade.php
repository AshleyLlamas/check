<div class="card border-0 rounded-0 shadow mb-3">
    <form>
        <div class="row g-0">
            <div class="card-body p-4">
                <h6 class="text-center">INGRESAR</h6>
                <hr class="mt-0 mb-4">
                @if (session()->has('error'))
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <div>
                            <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" name="emai" class="form-control @error('email') is-invalid @enderror" wire:model="email">
                            <label for="email" class="col-md-4 col-form-label">{{ __('Correo electrónico') }}</label>
                            @error('email')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    @switch($key)
                        @case(1)
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" name="curp" class="form-control @error('curp') is-invalid @enderror" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" wire:model="curp">
                                    <label for="curp" class="col-md-4 col-form-label">{{ __('CURP') }}</label>
                                    @error('curp')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        @break
                        @case(2)
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" wire:model="password">
                                    <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>
                                    @error('password')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        @break
                        @default

                    @endswitch
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 mb-4">
                <div class="text-center">
                    <button class="btn btn-primary" type="button" wire:click.prevent="save">Ingresar</button>
                </div>
                <div>
                    <button class="btn btn-light btn-sm" type="button" wire:click.prevent="cambiarKey"><i class="fa-solid fa-key" style="color: orange"></i> Ingresar por password</button>
                </div>
            </div>
        </div>
    </form>
</div>
