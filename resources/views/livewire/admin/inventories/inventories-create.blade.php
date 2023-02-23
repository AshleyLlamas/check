<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          @can('admin.inventories.index')
            <li class="breadcrumb-item"><a href="{{ route('admin.inventories.index') }}">Inventario</a></li>
          @endcan
          <li class="breadcrumb-item active" aria-current="page">Seleccionar categoria</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center my-2"><i class="fa-solid fa-list"></i> Categorias</h5>
        </div>
        <div class="card-body">
            <p class="ml-5"><b>Seleccione una categoria:</b></p>
            <div class="mx-5 mb-5">
                <div class="box w-100 text-success">
                    <div class="row">
                        <div class="col text-center">
                            <a href="{{ route('admin.electronics.create') }}" class="btn shadow-sm btn-light btn-lg p-5 w-100 border">
                                <i class="fa-solid fa-bolt fa-4x"></i>
                                <h2>Electrónicos</h2>
                                <span class="badge bg-white">{{$electronic_all}}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
