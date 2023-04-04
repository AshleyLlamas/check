<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          @can('admin.inventories.index')
            <li class="breadcrumb-item"><a href="{{ route('admin.inventories.index') }}">Inventario</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.inventories.create') }}">Seleccionar categoria</a></li>
          @endcan
          <li class="breadcrumb-item active" aria-current="page">Seleccionar electrónico</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center my-2"><i class="fa-solid fa-list"></i> Electrónicos</h5>
        </div>
        <div class="card-body">
            <p class="ml-5"><b>Seleccione un tipo de electrónico:</b></p>
            <div class="mx-5 mb-5">
                <div class="box w-100 text-success">
                    <div class="row text-center">
                        <div class="col pt-2">
                            <a href="{{ route('admin.printers.create') }}" class="btn shadow-sm btn-light btn-lg p-5 w-100 border">
                                <i class="fa-solid fa-print fa-4x"></i>
                                <h2>Impresoras</h2>
                                <span class="badge bg-white">{{$printers_all}}</span>
                            </a>
                        </div>
                        <div class="col pt-2">
                            <a href="{{ route('admin.computers.create') }}" class="btn shadow-sm btn-light btn-lg p-5 w-100 border">
                                <i class="fa-solid fa-computer fa-4x"></i>
                                <h2>Computadoras</h2>
                                <span class="badge bg-white">{{$computers_all}}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
