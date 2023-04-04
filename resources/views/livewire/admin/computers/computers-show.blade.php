<div class="py-4">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @can('admin.computers.index')
                <li class="breadcrumb-item"><a href="{{route('admin.computers.index')}}">Todas las computadoras</a></li>
            @endcan
            <li class="breadcrumb-item active">Ver computadora</li>
        </ol>
    </nav>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- /.card -->
                    @isset($computer->electronic->inventory->qr)
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa-solid fa-qrcode"></i> Código QR</h3>
                            </div>
                            <div class="card-body ">

                                    <div class="text-center pb-2">
                                        {!! QrCode::size(160)->generate($computer->electronic->inventory->qr); !!}
                                        <p>{{$computer->electronic->inventory->qr}}</p>
                                    </div>

                            </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    @endisset
                    <!-- Documentos -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa-solid fa-folder"></i> Documentos</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-6 pt-2">
                                    <button type="button" class="h-100 btn @isset($computer->electronic->inventory->garantia) btn-secondary @else btn-outline-secondary @endisset btn-block" data-toggle="modal" data-target="#garantia">Garantía</button>
                                </div>
                                <div class="col-12 col-lg-6 pt-2">
                                    <button type="button" class="h-100 btn @isset($computer->electronic->inventory->factura) btn-secondary @else btn-outline-secondary @endisset btn-block" data-toggle="modal" data-target="#factura">Factura</button>
                                </div>
                            </div>
                            <!-- Modal garantia -->
                            <div class="modal fade" id="garantia" tabindex="-1" aria-labelledby="garantiaLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header bg-secondary">
                                            <h5 class="modal-title" id="garantiaLabel">Garantía</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                @if($computer->electronic->inventory->garantia)
                                                    @php
                                                        $extension = pathinfo($computer->electronic->inventory->garantia)['extension'];
                                                    @endphp
                                                    @if($extension =="jpg" || $extension == "jpeg" || $extension == "png")
                                                        <div class="pt-3">
                                                            <img style="display: block; margin-left: auto; margin-right: auto;"  class="img-fluid" src="{{Storage::url($computer->electronic->inventory->garantia)}}">
                                                        </div>
                                                    @else
                                                        <iframe width="100%" height="500px" src="{{Storage::url($computer->electronic->inventory->garantia)}}" frameborder="0"></iframe>
                                                    @endif
                                                @else
                                                    <p class="text-danger text-center mb-1"><strong>No se encontró ningún archivo</strong></p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Factura -->
                            <div class="modal fade" id="factura" tabindex="-1" aria-labelledby="facturaLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header bg-secondary">
                                            <h5 class="modal-title" id="facturaLabel">Factura</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                @if($computer->electronic->inventory->factura)
                                                    @php
                                                        $extension = pathinfo($computer->electronic->inventory->factura)['extension'];
                                                    @endphp
                                                    @if($extension =="jpg" || $extension == "jpeg" || $extension == "png")
                                                        <div class="pt-3">
                                                            <img style="display: block; margin-left: auto; margin-right: auto;"  class="img-fluid" src="{{Storage::url($computer->electronic->inventory->factura)}}">
                                                        </div>
                                                    @else
                                                        <iframe width="100%" height="500px" src="{{Storage::url($computer->electronic->inventory->factura)}}" frameborder="0"></iframe>
                                                    @endif
                                                @else
                                                    <p class="text-danger text-center mb-1"><strong>No se encontró ningún archivo</strong></p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-9">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title pt-1"><i class="fa-solid fa-circle-info"></i> Información sobre la computadora</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div>
                                <strong>Categoría: </strong>
                                <span class="badge badge-pill badge-warning px-2">Electrónico</span>
                                <hr>
                                <div class="row text-center pt-2">
                                    <div class="col">
                                        <p><strong>Tipo:</strong>
                                        <br>
                                            @isset($computer->tipo)
                                                {{$computer->tipo}}
                                            @else
                                                N/A
                                            @endisset
                                        </p>
                                    </div>
                                    <div class="col">
                                        <p><strong>Marca:</strong>
                                        <br>
                                            @isset($computer->electronic->marca)
                                                {{$computer->electronic->marca}}
                                            @else
                                                N/A
                                            @endisset
                                        </p>
                                    </div>
                                    <div class="col">
                                        <p><strong>Modelo:</strong>
                                        <br>
                                            @isset($computer->electronic->modelo)
                                                {{$computer->electronic->modelo}}
                                            @else
                                                N/A
                                            @endisset
                                        </p>
                                    </div>
                                    <div class="col">
                                        <p><strong>Serie:</strong>
                                        <br>
                                            @isset($computer->electronic->serie)
                                                {{$computer->electronic->serie}}
                                            @else
                                                N/A
                                            @endisset
                                        </p>
                                    </div>
                                    <div class="col">
                                        <p><strong>Fecha de adquisición:</strong>
                                        <br>
                                            @isset($computer->electronic->inventory->fecha_de_adquisición)
                                                {{$computer->electronic->inventory->fecha_de_adquisición->format('d/m/Y')}}
                                            @else
                                                N/A
                                            @endisset
                                        </p>
                                    </div>
                                    <div class="col">
                                        <p><strong>Propietario:</strong><br>
                                            @switch($computer->electronic->inventory->propietariable_type)
                                                @case('App\Models\User')
                                                    @can('admin.users.show')
                                                        <a href="{{ route('admin.users.show', $computer->electronic->inventory->propietariable)}}">{{$computer->electronic->inventory->propietariable->name}}</a>
                                                    @else
                                                        {{$computer->electronic->inventory->propietariable->name}}
                                                    @endcan
                                                @break
                                                @case('App\Models\Area')
                                                    @can('admin.areas.show')
                                                        <a href="{{ route('admin.areas.show', $computer->electronic->inventory->propietariable)}}">{{$computer->electronic->inventory->propietariable->área}}</a>
                                                    @else
                                                        {{$computer->electronic->inventory->propietariable->área}}
                                                    @endcan
                                                @break
                                                @case(null)
                                                    N/A
                                                @break
                                                @default
                                            @endswitch
                                        </p>
                                    </div>
                                </div>
                                @isset($computer->electronic->inventory->descripción)
                                    <hr>
                                    <strong>Descripción:</strong>
                                    {!! $computer->electronic->inventory->descripción !!}
                                @endisset
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
