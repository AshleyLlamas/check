<div class="py-4">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @can('admin.admonitions.index')
                <li class="breadcrumb-item"><a href="{{route('admin.admonitions.index')}}">Todas las amonestaciones</a></li>
            @endcan
            <li class="breadcrumb-item active">Ver amonestación</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <div class="btn-group" role="group" aria-label="Basic example">
                @can('admin.admonitions.pdfs')
                    <a class="btn btn-secondary btn-sm" href="{{ route('pdfs.admonitions.view', $admonition) }}"><i class="fa-solid fa-file-pdf"></i> PDF</a>
                @endcan
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="border border-dark table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr scope="row" class="align-middle">
                            <th colspan="5" class="mb-1"><p class="mb-1">{{$admonition->created_at->format("d/m/Y")}}</p></th>
                        </tr>
                        <tr scope="row" class="align-middle text-center">
                            <th colspan="5" class="mb-1"><h3>Amonestación</h3></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <th colspan="5"><p class="bg-dark mb-1">DATOS DEL AMONESTADO</p></th>
                        </tr>
                        <tr scope="row" class="align-middle text-uppercase">
                            <th>
                                <p class="mb-1">COD. EMP. 
                                    <span class="text-secondary pl-3">
                                        @isset($admonition->amonestado->número_de_empleado)
                                            {{$admonition->amonestado->número_de_empleado}}
                                        @else
                                            N/A
                                        @endisset
                                    </span>
                                </p>
                            </th>
                            <th colspan="2">
                                <p class="mb-1">PUESTO
                                    <span class="text-secondary pl-3">
                                        @isset($admonition->amonestado->puesto)
                                            {{$admonition->amonestado->puesto}}
                                        @else
                                            N/A
                                        @endisset
                                    </span>
                                </p>
                            </th>
                            <th>
                                <p class="mb-1">OBRA/DEPTO
                                    <span class="text-secondary pl-3">
                                        
                                    </span>
                                </p>
                            </th>
                            <th>
                                <p class="mb-1">C.C
                                    <span class="text-secondary pl-3">
                                        @isset($admonition->amonestado->cost_center->folio)
                                            {{$admonition->amonestado->cost_center->folio}}
                                        @else
                                            N/A
                                        @endisset
                                    </span>
                                </p>
                            </th>
                        </tr>
                        <tr scope="row">
                            <th colspan="5">
                                <p class="mb-1">AMONESTADO:
                                    <span class="text-secondary pl-3">
                                        @isset($admonition->amonestado->name)
                                            {{$admonition->amonestado->name}}
                                        @else
                                            N/A
                                        @endisset
                                    </span>
                                </p>
                            </th>
                        </tr>
                        <tr class="text-center">
                            <th colspan="5"><p class="bg-dark mb-1">TIPO DE AMONESTACIÓN</p></th>
                        </tr>
                        <tr scope="row" class="align-top">
                            <th colspan="5">
                                <div class="row text-center">
                                    <div class="col mx-5">
                                        <p class="mb-1 border rounded border-dark bg-success text-uppercase">
                                            {{$admonition->admonitionType->tipo}}
                                        </p>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        @isset($admonition->solicitante)
                            <tr class="text-center">
                                <th colspan="5"><p class="bg-dark mb-1">DATOS DEL SOLICITANTE</p></th>
                            </tr>
                            <tr scope="row" class="align-middle text-uppercase">
                                <th>
                                    <p class="mb-1">COD. EMP. 
                                        <span class="text-secondary pl-3">
                                            @isset($admonition->solicitante->número_de_empleado)
                                                {{$admonition->solicitante->número_de_empleado}}
                                            @else
                                                N/A
                                            @endisset
                                        </span>
                                    </p>
                                </th>
                                <th colspan="2">
                                    <p class="mb-1">PUESTO
                                        <span class="text-secondary pl-3">
                                            @isset($admonition->solicitante->puesto)
                                                {{$admonition->solicitante->puesto}}
                                            @else
                                                N/A
                                            @endisset
                                        </span>
                                    </p>
                                </th>
                                <th>
                                    <p class="mb-1">OBRA/DEPTO
                                        <span class="text-secondary pl-3">
                                            
                                        </span>
                                    </p>
                                </th>
                                <th>
                                    <p class="mb-1">C.C
                                        <span class="text-secondary pl-3">
                                            @isset($admonition->solicitante->cost_center->folio)
                                                {{$admonition->solicitante->cost_center->folio}}
                                            @else
                                                N/A
                                            @endisset
                                        </span>
                                    </p>
                                </th>
                            </tr>
                            <tr scope="row">
                                <th colspan="5">
                                    <p class="mb-1">SOLICITANTE:
                                        <span class="text-secondary pl-3">
                                            @isset($admonition->solicitante->name)
                                                {{$admonition->solicitante->name}}
                                            @else
                                                N/A
                                            @endisset
                                        </span>
                                    </p>
                                </th>
                            </tr>
                        @endisset
                        <tr class="text-center">
                            <th colspan="5"><p class="bg-dark mb-1">OBSERVACIONES</p></th>
                        </tr>
                        <tr>
                            <th colspan="5">
                                <div class="mx-5 my-3 p-3 border rounded border-dark">
                                    {!!$admonition->observaciones!!}
                                </div>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('css')
    <style>
        .borderless td, .borderless th {
            border: none;
        }

        table, p{
            user-select: none;
        }
    </style>
@endpush