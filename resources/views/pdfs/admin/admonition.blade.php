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
        <p class="mb-1">{{$admonition->created_at->format("d/m/Y")}}</p>
        <div class="contenido">
            <!-- TABLA -->
            
            <table class="table table-borderless">
                <thead>
                    <tr scope="row" class="align-middle text-center">
                        <th colspan="5" class="mb-1"><p style="font-size: 20px">Amonestación</p></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <th colspan="5"><p class="bg-dark mb-1 text-white">DATOS DEL AMONESTADO</p></th>
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
                        <th colspan="5"><p class="bg-dark mb-1 text-white">TIPO DE AMONESTACIÓN</p></th>
                    </tr>
                    <tr scope="row" class="align-top">
                        <th colspan="5">
                            <div class="text-center">
                                <div class="mx-5">
                                    <p class="mb-1 border rounded border-dark text-uppercase">
                                        {{$admonition->admonitionType->tipo}}
                                    </p>
                                </div>
                            </div>
                        </th>
                    </tr>
                    @isset($admonition->solicitante)
                        <tr class="text-center">
                            <th colspan="5"><p class="bg-dark mb-1 text-white">DATOS DEL SOLICITANTE</p></th>
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
                        <th colspan="5"><p class="bg-dark mb-1 text-white">OBSERVACIONES</p></th>
                    </tr>
                    <tr>
                        <th colspan="5">
                            <div class="mx-5 p-3 border rounded border-dark">
                                {!!$admonition->observaciones!!}
                            </div>
                        </th>
                    </tr>
                </tbody>
            </table>

            <!-- CIERRE DE LA TABLA -->
        </div>
    </body>
</html>