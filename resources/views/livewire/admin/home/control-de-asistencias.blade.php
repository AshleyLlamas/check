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
                                      <span class="info-box-number h1">{{$justificaciones}}</span>
                                      <span class="info-box-text">Empleados que justificaron o en vacaciones</span>
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
