<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>PDF</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <!-- STILE -->
        <style>
            body{
                font-family: "source_sans_proregular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;
                text-align: justify;
            }

            p{
                font-size: 10px;
            }
        </style>
    </head>
    <body>
        <p class="mb-1">{{$administrative_record->created_at->format("d/m/Y")}}</p>
        <div class="contenido">
            <!-- TABLA -->

                <table class="table table-borderless">
                    <thead>
                        <tr scope="row" class="align-middle text-center">
                            <th colspan="5"><p style="font-size: 20px">Acta administrativa</p></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <th colspan="5"><p class="bg-dark mb-1 text-white">DATOS DEL COLABORADOR</p></th>
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
                            <th colspan="5"><p class="bg-dark mb-1 text-white">TIPO DE AMONESTACIÓN</p></th>
                        </tr>
                        <tr scope="row" class="align-top">
                            <th colspan="5">
                                <div class="text-center">
                                    <div class="mx-5">
                                        <p class="mb-1 border rounded border-dark text-uppercase">
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
                            <th colspan="5"><p class="bg-dark mb-1 text-white">CATEGORIA DEL PERMISO</p></th>
                        </tr>
                        <tr scope="row" class="align-top">
                            <th colspan="5">
                                <div class="text-center">
                                    <div class="mx-5">
                                        <p class="mb-1 pl-2 border rounded border-dark text-uppercase">
                                            {{$administrative_record->categoria_del_permiso}} {{$administrative_record->fecha_del_permiso->format("d/m/Y")}}
                                        </p>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr class="text-center">
                            <th colspan="5"><p class="bg-dark mb-1 text-white">OBSERVACIONES</p></th>
                        </tr>
                        <tr>
                            <th colspan="5">
                                <div class="mx-5 p-3 border rounded border-dark">
                                    {!!$administrative_record->observaciones!!}
                                </div>
                            </th>
                        </tr>
                        <tr class="text-center">
                            <th colspan="5"><p class="bg-dark mb-1 text-white">COMENTARIOS DEL COLABORADOR</p></th>
                        </tr>
                        <tr>
                            <th colspan="5">
                                {{-- <div class="mx-5 p-3 border rounded border-dark">
                                    {!!$administrative_record->comentarios_del_colaborador!!}
                                </div> --}}
                                <img width="100%" src="{{asset('storage/'.$administrative_record->comentarios_del_colaborador)}}" alt="">
                            </th>
                        </tr>
                    </tbody>
                </table>

            <!-- CIERRE DE LA TABLA -->
        </div>
    </body>
</html>
