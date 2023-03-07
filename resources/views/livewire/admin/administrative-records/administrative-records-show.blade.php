<div class="py-4">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @can('admin.administrative_records.index')
                <li class="breadcrumb-item"><a href="{{route('admin.administrative_records.index')}}">Todas las actas administrativas</a></li>
            @endcan
            <li class="breadcrumb-item active">Ver acta administrativa</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <div class="btn-group" role="group" aria-label="Basic example">
                @can('admin.administrative_records.pdfs')
                    <a class="btn btn-secondary btn-sm" href="{{ route('pdfs.administrative_records.view', $administrative_record) }}"><i class="fa-solid fa-file-pdf"></i> PDF</a>
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
                            <th colspan="5" class="mb-1"><p class="mb-1">{{$administrative_record->created_at->format("d/m/Y")}}</p></th>
                        </tr>
                        <tr scope="row" class="align-middle text-center">
                            <th colspan="5" class="mb-1"><h3>Acta administrativa</h3></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <th colspan="5"><p class="bg-dark mb-1">DATOS DEL COLABORADOR</p></th>
                        </tr>
                        <tr scope="row" class="align-middle text-uppercase">
                            <th>
                                <p class="mb-1">COD. EMP.
                                    <span class="text-secondary pl-3">
                                        @isset($administrative_record->colaborador->número_de_empleado)
                                            {{$administrative_record->colaborador->número_de_empleado}}
                                        @else
                                            N/A
                                        @endisset
                                    </span>
                                </p>
                            </th>
                            <th colspan="2">
                                <p class="mb-1">PUESTO
                                    <span class="text-secondary pl-3">
                                        @isset($administrative_record->colaborador->puesto)
                                            {{$administrative_record->colaborador->puesto}}
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
                                        @isset($administrative_record->cost_center->folio)
                                            {{$administrative_record->cost_center->folio}}
                                        @else
                                            N/A
                                        @endisset
                                    </span>
                                </p>
                            </th>
                        </tr>
                        <tr scope="row">
                            <th colspan="5">
                                <p class="mb-1">COLABORADOR:
                                    <span class="text-secondary pl-3">
                                        @isset($administrative_record->colaborador->name)
                                            {{$administrative_record->colaborador->name}}
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
                                <div class="text-center">
                                    <div class="mx-5">
                                        <p class="mb-1 border rounded border-dark bg-success text-uppercase">
                                            {{$administrative_record->admonitionType->tipo}}
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <small>
                                        <p class="mx-5 mt-3 text-justify">La presente <span class="text-danger">amonestación</span> se efectúa por una violación por parte del trabajador tanto al artículo 47 de la LFT así como al reglamento interno de la Compañía, por lo que de tratarse de una falta de tal magnitud que impida la relación laboral entre el trabajador y la empresa, se procederá sin prejuicio para la misma conforme a las fracciones contenidas tanto en el art. 47 de la LFT como del reglamento interno.</p>
                                    </small>
                                </div>
                            </th>
                        </tr>
                        <tr class="text-center">
                            <th colspan="5"><p class="bg-dark mb-1">CATEGORIA DEL PERMISO</p></th>
                        </tr>
                        <tr scope="row" class="align-top">
                            <th colspan="5">
                                <div class="row text-center">
                                    <div class="col mx-5">
                                        <p class="font-italic">DIA DE AUSENCIA</p>
                                        <p class="mb-1 pl-2 border rounded border-dark @if($administrative_record->categoria_del_permiso == 'Día de ausencia') bg-success @endif">
                                            FECHA AUSENCIA @if($administrative_record->categoria_del_permiso == 'Día de ausencia') {{$administrative_record->fecha_del_permiso->format("d/m/Y")}} @endif
                                        </p>
                                    </div>
                                    <div class="col mx-5">
                                        <p class="font-italic">DIA DE SUSPENSIÓN</p>
                                        <p class="mb-1 pl-2 border rounded border-dark @if($administrative_record->categoria_del_permiso == 'Fecha de suspención') bg-success @endif">
                                            FECHA DE SUSPENSIÓN @if($administrative_record->categoria_del_permiso == 'Fecha de suspención') {{$administrative_record->fecha_del_permiso->format("d/m/Y")}} @endif
                                        </p>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr class="text-center">
                            <th colspan="5"><p class="bg-dark mb-1">OBSERVACIONES</p></th>
                        </tr>
                        <tr>
                            <th colspan="5">
                                <div class="mx-5 my-3 p-3 border rounded border-dark">
                                    {!!$administrative_record->observaciones!!}
                                </div>
                            </th>
                        </tr>
                        <tr class="text-center">
                            <th colspan="5"><p class="bg-dark mb-1">COMENTARIOS DEL COLABORADOR</p></th>
                        </tr>
                        <tr>
                            <th colspan="5">
                                {{-- <div class="mx-5 my-3 p-3 border rounded border-dark">
                                    {!!$administrative_record->comentarios_del_colaborador!!}
                                </div> --}}
                                @if($administrative_record->comentarios_del_colaborador)
                                    @php
                                        $extension = pathinfo($administrative_record->comentarios_del_colaborador)['extension'];
                                    @endphp
                                    @if($extension =="jpg" || $extension == "jpeg" || $extension == "png")
                                        <div class="pt-3">
                                            <img style="display: block; margin-left: auto; margin-right: auto;"  class="img-fluid" src="{{Storage::url($administrative_record->comentarios_del_colaborador)}}">
                                        </div>
                                    @endif
                                @endif
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
