<div>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @can('admin.safeties.index')
                <li class="breadcrumb-item"><a href="{{route('admin.safeties.index')}}">Todos los incidentes</a></li>
            @endcan
            <li class="breadcrumb-item active">Ver incidente</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center mb-1">{{$safety->tipo}}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6 col-xl-6">
                    @can('admin.users.show')
                        <a href="{{ route('admin.users.show', $safety->user) }}">
                    @endcan
                        <div class="card bg-light shadow-none border h-100">
                            <div class="row  m-3 pt-2">
                                <div class="col-4">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                        src="@if($safety->user->image) {{Storage::url($safety->user->image->url)}} @else {{asset('recursos/foto-default.png')}} @endif"
                                        alt="Fotografía">
                                    </div>
                                </div>
                                <div class="col-8">
                                    <h3 class="profile-username text-center">{{$safety->user->name}}</h3>

                                    @isset($safety->user->puesto)
                                        <p class="text-muted text-center mb-0 pb-0">{{$safety->user->puesto}}</p>
                                    @endisset
                                    @isset($safety->user->tipo_de_puesto)
                                        <p class="text-muted text-center mb-1"><small>({{$safety->user->tipo_de_puesto}})</small></p>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    @can('admin.users.show')
                        </a>
                    @endcan
                </div>
                <div class="col-12 col-md-6 col-xl-6">
                    <div class="card shadow-none border h-100">
                        <div class="text-center pt-4">
                            <h5 class="mb"><b><i class="fa-regular fa-calendar"></i> Fecha</b> <br> <p class="text-secondary">{{$safety->fecha->formatlocalized('%d/%m/%Y')}}</p></h5>
                            <p class="mb"><b>Tipo de incidente</b> <br> <span class="text-secondary">{{$safety->tipo}}</span></p>
                            @isset($safety->area)
                                <p class="mb"><b>Área / Proyecto</b> <br> 
                                    <span class="text-secondary">
                                        @can('admin.areas.show')
                                            <a href="{{route('admin.areas.show', $safety->area)}}">{{$safety->area->área}}</a>
                                        @else
                                            {{$safety->area->área}}
                                        @endcan
                                    </span></p>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <h5 class="text-center">Evidencias</h5>
            <div class="row">
                @foreach($safety->images as $i => $image)
                    <div class="col-12 col-lg-6 pt-2">
                        <button type="button" class="h-100 btn btn-secondary btn-block" data-toggle="modal" data-target="#foto{{$i}}">Evidencia {{($i+1)}}</button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="foto{{$i}}" tabindex="-1" aria-labelledby="foto{{$i}}Label" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header bg-secondary">
                                    <h5 class="modal-title" id="foto{{$i}}Label">Evidencia {{($i+1)}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        @if($image->url)
                                            @php
                                                $extension = pathinfo($image->url)['extension'];
                                            @endphp
                                            @if($extension =="jpg" || $extension == "jpeg" || $extension == "png")
                                                <div class="pt-3">
                                                    <img style="display: block; margin-left: auto; margin-right: auto;"  class="img-fluid" src="{{Storage::url($image->url)}}">
                                                </div>
                                            @else
                                                <iframe width="100%" height="500px" src="{{Storage::url($image->url)}}" frameborder="0"></iframe>
                                            @endif
                                        @else
                                            <p class="text-danger text-center mb-1"><strong>No se encontró ningún archivo</strong></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
