<div class="pt-4">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center my-2"><i class="fa-solid fa-list"></i> Artículos del inventario <span class="badge badge-light"> {{$all_inventories}}</span></h5>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12">
                    <a class="btn @if($filtrar == false) btn-secondary @else btn-light @endif btn-block  my-2" wire:click.prevent="filtrar()"><i class="fas fa-search"></i> Ordenar y filtrar</a>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-light btn-block my-2" data-toggle="modal" data-target="#escannerModal"><i class="fa-solid fa-qrcode"></i> Escanear QR</button>
                </div>
                <div class="col-xl-5 col-lg-2 col-md-12 col-sm-12">

                </div>
                <div class="col-xl-1 col-lg-2 col-md-12 col-sm-12">
                    <a class="btn btn-success btn-block  my-2 @cannot('admin.inventories.create') disabled @endcannot" href="{{ route('admin.inventories.create') }}"><i class="fa-solid fa-plus"></i></a>
                </div>
            </div>
        </div>
        {{--ESCANER MODAL --}}
        <div class="modal fade" id="escannerModal" tabindex="-1" role="dialog" aria-labelledby="escannerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="escannerModalLabel">Escaner</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="border-0" id="qr-reader" style="width:100%; height=500px"></div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0 table-responsive">

                <table class="table table-hover text-center">
                    <thead>
                        @if ($filtrar)
                            <tr class="bg-light">
                                <th>
                                    <span>Ordenar por:</span>
                                </th>
                                <th class="m-2" colspan="4">
                                    <select class="form-control form-control-sm text-center" wire:model="order">
                                        <option value="1">Ordenar por más reciente (# ID)</option>
                                        <option value="2">Ordenar por más antiguo (# ID)</option>
                                        <option value="3">Ordenar por QR (A-Z)</option>
                                        <option value="4">Ordenar por QR (Z-A)</option>
                                    </select>
                                </th>
                                @can('admin.users.show')
                                    <th></th>
                                @endcan
                                @can('admin.users.edit')
                                    <th></th>
                                @endcan
                                @can('admin.users.destroy')
                                    <th></th>
                                @endcan
                            </tr>
                            <tr class="bg-light">
                                <th>
                                    <span>Filtrar por:</span>
                                </th>
                                <th class="m-2">
                                    <input wire:model="searchQr" class="form-control form-control-sm text-center" placeholder="QR">
                                </th>
                                <th class="m-2">
                                    <select class="form-control form-control-sm text-center" id="searchCategoria" wire:model="searchCategoria">
                                        <option value="">-- Categoría --</option>
                                        <option value="App\Models\Electronic">Electrónico</option>
                                    </select>
                                </th>
                                <th class="m-2">
                                    <select class="form-control form-control-sm text-center" id="searchArticulo" wire:model="searchArticulo">
                                        <option value="">-- Artículo --</option>
                                        <option value="App\Models\Phone">Teléfono</option>
                                        <option value="App\Models\Printer">Impresora</option>
                                        <option value="App\Models\Computer">Computadora</option>
                                        <option value="App\Models\Screen">Pantalla</option>
                                        <option value="App\Models\Disk">Disco duro</option>
                                        <option value="App\Models\Accesories">Accesorios de computadora</option>
                                    </select>
                                </th>
                                <th class="m-2">
                                    {{-- <select class="form-control form-control-sm text-center" id="searchPropietario" wire:model="searchPropietario">
                                        <option value="">-- Propietario --</option>
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select> --}}
                                </th>
                                @can('admin.inventories.show')
                                    <th class="p-0"></th>
                                @endcan
                                @can('admin.inventories.edit')
                                    <th class="p-0"></th>
                                @endcan
                                @can('admin.inventories.destroy')
                                    <th class="p-0"></th>
                                @endcan
                            </tr>
                        @endif
                        <tr>
                            <th>#</th>
                            <th>Clave QR</th>
                            <th>Categoría</th>
                            <th>Atículo</th>
                            <th>Propietario</th>
                            @can('admin.inventories.show')
                                <th></th>
                            @endcan
                            @can('admin.inventories.edit')
                                <th></th>
                            @endcan
                            @can('admin.inventories.destroy')
                                <th></th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @if ($inventories->count())
                            @foreach ($inventories as $inventory)
                                <tr>
                                    <td>{{$inventory->id}}</td>
                                    <td>
                                        @isset($inventory->qr)
                                            {{$inventory->qr}}
                                        @endisset
                                    </td>
                                    <td>
                                        @switch($inventory->inventariable_type)
                                            @case('App\Models\Electronic')
                                                Electrónico
                                                @break
                                            @default
                                                N/A
                                        @endswitch
                                    </td>
                                    <td>
                                        @switch($inventory->inventariable->electronicable_type)
                                            @case('App\Models\Phone')
                                                Teléfono
                                                @break
                                            @case('App\Models\Printer')
                                                Impresora
                                                @break
                                            @case('App\Models\Computer')
                                                Computadora
                                                @break
                                            @case('App\Models\Screen')
                                                Pantalla
                                                @break
                                            @case('App\Models\Disk')
                                                Disco duro
                                                @break
                                            @case('App\Models\Accesories')
                                                Accesorio
                                                @break
                                            @default
                                                N/A
                                        @endswitch
                                    </td>
                                    <td>
                                        @switch($inventory->propietariable_type)
                                            @case('App\Models\User')
                                                {{$inventory->propietariable->name}}
                                                @break
                                            @case('App\Models\Area')
                                                {{$inventory->propietariable->área}}
                                                @break
                                            @default
                                                N/A
                                        @endswitch
                                    </td>
                                    @can('admin.inventories.show')
                                        <td width="10px">
                                            @switch($inventory->inventariable->electronicable_type)
                                                @case('App\Models\Phone')
                                                        <a class="btn btn-default btn-sm" href="{{route('admin.phones.show', $inventory->inventariable->electronicable)}}"><i class="fa-solid fa-eye"></i></a>
                                                    @break
                                                @case('App\Models\Printer')
                                                        <a class="btn btn-default btn-sm" href="{{route('admin.printers.show', $inventory->inventariable->electronicable)}}"><i class="fa-solid fa-eye"></i></a>
                                                    @break
                                                @case('App\Models\Computer')
                                                        <a class="btn btn-default btn-sm" href="{{route('admin.computers.show', $inventory->inventariable->electronicable)}}"><i class="fa-solid fa-eye"></i></a>
                                                    @break
                                                @case('App\Models\Screen')
                                                        <a class="btn btn-default btn-sm" href="{{route('admin.screens.show', $inventory->inventariable->electronicable)}}"><i class="fa-solid fa-eye"></i></a>
                                                    @break
                                                @case('App\Models\Disk')
                                                        <a class="btn btn-default btn-sm" href="{{route('admin.disks.show', $inventory->inventariable->electronicable)}}"><i class="fa-solid fa-eye"></i></a>
                                                    @break
                                                @case('App\Models\Accesorie')
                                                        <a class="btn btn-default btn-sm" href="{{route('admin.accesories.show', $inventory->inventariable->electronicable)}}"><i class="fa-solid fa-eye"></i></a>
                                                    @break
                                                @default
                                                    N/A
                                            @endswitch
                                        </td>
                                    @endcan
                                    @can('admin.inventories.edit')
                                        <td width="10px">
                                            @switch($inventory->inventariable->electronicable_type)
                                                @case('App\Models\Phone')
                                                        <a class="btn btn-default btn-sm" href="{{route('admin.phones.edit', $inventory->inventariable->electronicable)}}"><i class="fas fa-edit"></i></a>
                                                    @break
                                                @case('App\Models\Printer')
                                                        <a class="btn btn-default btn-sm" href="{{route('admin.printers.edit', $inventory->inventariable->electronicable)}}"><i class="fas fa-edit"></i></a>
                                                    @break
                                                @case('App\Models\Computer')
                                                        <a class="btn btn-default btn-sm" href="{{route('admin.computers.edit', $inventory->inventariable->electronicable)}}"><i class="fas fa-edit"></i></a>
                                                    @break
                                                @case('App\Models\Screen')
                                                        <a class="btn btn-default btn-sm" href="{{route('admin.screens.edit', $inventory->inventariable->electronicable)}}"><i class="fas fa-edit"></i></a>
                                                    @break
                                                @case('App\Models\Disk')
                                                        <a class="btn btn-default btn-sm" href="{{route('admin.disks.edit', $inventory->inventariable->electronicable)}}"><i class="fas fa-edit"></i></a>
                                                    @break
                                                @case('App\Models\Accesorie')
                                                        <a class="btn btn-default btn-sm" href="{{route('admin.accesories.edit', $inventory->inventariable->electronicable)}}"><i class="fas fa-edit"></i></a>
                                                    @break
                                                @default
                                                    N/A
                                            @endswitch
                                        </td>
                                    @endcan
                                    @can('admin.inventories.destroy')
                                        <td width="10px">
                                            <form action="{{ route('admin.inventories.destroy', $inventory) }}" method="POST" class="alert-delete">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="delete()"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        @else
                            <tr scope="row">
                                <td colspan="5">
                                    <p class="text-center text-danger pt-3"><strong>Sin registro</strong></p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
        </div>
        <div class="card-footer">
            {{$inventories->links()}}
        </div>
    </div>
</div>

@push('css')
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="css/templatemo-woox-travel.css">
    <link rel="stylesheet" href="css/owl.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

    <style>
    #qr-reader button{
        background-color: #0d6efd;
        padding: 15px;
        border-radius: 5px;
        border: 0;
        color: white;
    }
    </style>
@endpush

@push('js')
    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
            '¡Eliminado!',
            'El artículo del inventario se elimino con éxito.',
            'success'
            )
        </script>
    @endif

    <script>
        $('.alert-delete').submit(function (e) {
        e.preventDefault();
        Swal.fire({
        title: '¿Estas seguro?',
        text: "El artículo del inventario se eliminara definitivamente",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, ¡Eliminar!',
        cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    </script>

    {{-- ESCANNER --}}
    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <script>
    function bannerSwitcher() {
        next = $('.sec-1-input').filter(':checked').next('.sec-1-input');
        if (next.length) next.prop('checked', true);
        else $('.sec-1-input').first().prop('checked', true);
    }
    var bannerTimer = setInterval(bannerSwitcher, 5000);
    $('nav .controls label').click(function() {
        clearInterval(bannerTimer);
        bannerTimer = setInterval(bannerSwitcher, 5000)
    });
    </script>


    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="https://raw.githubusercontent.com/mebjas/html5-qrcode/master/minified/html5-qrcode.min.js"></script>

    <script>
    function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete" || document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }
    docReady(function() {
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });

        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                console.log(`Scan result = ${decodedText}`, decodedResult);

                //resultContainer.innerHTML += `<div>[${countResults}] - ${decodedText}</div>`;
                location.replace(decodedText);

                // Optional: To close the QR code scannign after the result is found
                html5QrcodeScanner.clear();
            }
        }

        // Optional callback for error, can be ignored.
        function onScanError(qrCodeError) {
            // This callback would be called in case of qr code scan error or setup error.
            // You can avoid this callback completely, as it can be very verbose in nature.
        }

        html5QrcodeScanner.render(onScanSuccess, onScanError);
    });
    </script>
@endpush
