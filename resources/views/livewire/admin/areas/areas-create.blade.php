<div class="py-4">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @can('admin.areas.index')
                <li class="breadcrumb-item"><a href="{{route('admin.areas.index')}}">Todas las áreas</a></li>
            @endcan
            <li class="breadcrumb-item active">Nueva área</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center my-2">{{$área}}</h5>
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
                                <h5 class="py-1 text-center">Área</h5>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label class="col-form-label">
                                        {{ __('Nombre completo') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="área" class="form-control" wire:model="área" placeholder="Ingrese el nombre del área">
                                    @error('área') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-12">
                                    <div wire:ignore>
                                        <label class="col-form-label">
                                            {{ __('Encargado') }}
                                        </label>
                                        <select class="form-control" id="users">
                                            <option value="">Selecciona una opción</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id}}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('user') <span class="text-danger error">{{ $message }}</span>@enderror
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

@push('js')
    <script>
        $(document).ready(function () {
            $('#users').select2();

            $('#users').on('change', function (e) {
                var data = $('#users').select2("val");
            @this.set('encargado', data);
            });
        });
    </script>
@endpush