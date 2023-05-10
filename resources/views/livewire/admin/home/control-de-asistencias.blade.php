<div>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <input type="date" id="fecha" class="form-control" wire:model="fecha">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 rounded bg-light">
                    <div class="pt-3 px-3 border-bottom border-white">
                        <div class="text-right">
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
                                      <span class="info-box-text">Total de empleados</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col text-center">
                                <div class="info-box bg-withe">
                                    <div class="info-box-content">
                                      <span class="info-box-number h1">{{$asistencias}}</span>
                                      <span class="info-box-text">Empleados que asistieron</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col text-center">
                                <div class="info-box bg-danger">
                                    <div class="info-box-content">
                                      <span class="info-box-number h1">{{$faltaron}}</span>
                                      <span class="info-box-text">Empleados que faltaron</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col text-center">
                                <div class="info-box bg-warning">
                                    <div class="info-box-content">
                                      <span class="info-box-number h1">{{$justificaciones}} / {{$vacaciones}}</span>
                                      <span class="info-box-text">Empleados que justificaron o en vacaciones</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                              <tr>
                                <th scope="col">Empresa / Compañia</th>
                                <th scope="col">Total de empleados</th>
                                <th scope="col">Empleados que asistieron</th>
                                <th scope="col">Empleados que faltaron</th>
                                <th scope="col">Empleados que justificaron o en vacaciones</th>
                              </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($companies as $company)
                                    <tr>
                                        <th scope="col">{{$company->nombre_de_la_compañia}}</th>
                                        <td>{{$company->users->count()}}</td>
                                        <td>{{$this->userAssistances($company->id)}}</td>
                                        <td>{{$this->userNoAssistances($company->id)}}</td>
                                        <td>{{$this->userJustifyAttendances($company->id)}}/{{ $this->userVacations($company->id)}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
                <div class="col-12 rounded bg-light">
                    <div class="pt-3 px-3 border-bottom border-white">
                        <h3 class="text-left text-secondary mb-1">SEGURIDAD E HIGIENE</h3>
                    </div>
                    <div class="pt-3">
                        <div class="row">
                            <div class="col text-center">
                                <div class="info-box bg-danger">
                                    <div class="info-box-content">
                                      <span class="info-box-number h1">{{$fatalidad}}</span>
                                      <span class="info-box-text">Fatalidad</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col text-center">
                                <div class="info-box bg-warning">
                                    <div class="info-box-content">
                                      <span class="info-box-number h1">{{$primeros_auxilios}}</span>
                                      <span class="info-box-text">Primeros Auxilios</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col text-center">
                                <div class="info-box bg-warning">
                                    <div class="info-box-content">
                                      <span class="info-box-number h1">{{$accidentes_de_trabajo}}</span>
                                      <span class="info-box-text">Accidentes de trabajo</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col text-center">
                                <div class="info-box bg-warning">
                                    <div class="info-box-content">
                                      <span class="info-box-number h1">{{$incidentes_propiedad}}</span>
                                      <span class="info-box-text">Incidentes a la propiedad</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col text-center">
                                <div class="info-box bg-success">
                                    <div class="info-box-content">
                                      <span class="info-box-number h1">{{$incidentes_ambientales}}</span>
                                      <span class="info-box-text">Incidentes ambientales</span>
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
