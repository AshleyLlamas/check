<div>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <input type="date" id="fecha" class="form-control" wire:model="fecha">
                </div>
                <div class="col">
                    <select class="form-control" id="company" wire:model="company">
                        @foreach ($companies as $company)
                            <option value="{{$company->id}}">{{$company->nombre_de_la_compañia}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">

                </div>
                <div class="col-8 rounded bg-light">
                    <div class="pt-3 px-3 border-bottom border-white">
                        <div class="text-right">
                            <h5 class="text-mb-1">Planta - {{$compañia}}</h5>
                            <h5 class="text-mb-1 text-primary">{{$fecha}}</h5>
                        </div>
                        <h3 class="text-left text-secondary mb-1">CONTROL DE ASISTENCIA</h3>
                    </div>
                    <div class="pt-3">
                        <div class="row">
                            <div class="col text-center">
                                <div class="info-box bg-primary">
                                    <div class="info-box-content">
                                      <span class="info-box-number h1">{{$empleados}}</span>
                                      <span class="info-box-text">EMPLEADOS</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col text-center">
                                <div class="info-box bg-withe">
                                    <div class="info-box-content">
                                      <span class="info-box-number h1">{{$asistencias}}</span>
                                      <span class="info-box-text">ASISTIERON</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col text-center">
                                <div class="info-box bg-withe">
                                    <div class="info-box-content">
                                      <span class="info-box-number h1">{{$con_retardo}}</span>
                                      <span class="info-box-text">CON RETARDO</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col text-center">
                                <div class="info-box bg-warning">
                                    <div class="info-box-content">
                                      <span class="info-box-number h1">{{$faltaron}}</span>
                                      <span class="info-box-text">FALTARON</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-3 px-3 border-bottom border-white">
                        <h3 class="text-left text-secondary mb-1">INSIDENCIAS | EHS ( Environmental health and safety )</h3>
                    </div>
                    <div class="pt-3">
                        <div class="row">
                            <div class="col text-center h-100">
                                <h5>ACCIDENTES<br>FALTANTES</h5>
                                <div class="info-box bg-danger">
                                    <div class="info-box-content">
                                      <span class="info-box-number h1">X</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col text-center h-100">
                                <h5>ACCIDENTES<br>DE TRABAJO</h5>
                                <div class="info-box bg-warning">
                                    <div class="info-box-content">
                                      <span class="info-box-number h1">X</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col text-center h-100">
                                <h5>PRIMEROS<br>AUXILIOS</h5>
                                <div class="info-box bg-primary">
                                    <div class="info-box-content">
                                      <span class="info-box-number h1">X</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col text-center h-100">
                                <h5>INCIDENTES A<br>LA PROPIEDAD</h5>
                                <div class="info-box bg-secondary">
                                    <div class="info-box-content">
                                      <span class="info-box-number h1">X</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col text-center h-100">
                                <h5>INCIDENTES<br>DE AMBIENTALES</h5>
                                <div class="info-box bg-success">
                                    <div class="info-box-content">
                                      <span class="info-box-number h1">X</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
