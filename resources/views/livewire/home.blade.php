<div>
    @if ($users->count())
        <div class="card border-0 rounded-0 gradient-custom">
            <div class="card-header">
                <h3 class="text-center pt-3 text-white">USUARIOS CON INASISTENCIAS</h3>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($users as $user)
                        <div class="col">
                            <div class="card border-0 mb-3 text-center bg-white">
                                <div class="row g-0">
                                    <div class="col-md-4 p-2">
                                        <img draggable="false" class="img-fluid rounded" src="@if($user->image) {{Storage::url($user->image->url)}} @else {{asset('recursos/foto-default.png')}} @endif"/>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body text-center p-1">
                                            <h4 class="pt-3">{{$user->name}}</h4>
                                            <hr class="mt-0">
                                            <div class="row">
                                                <div class="col">
                                                    <h2><span class="badge bg-secondary">{{$user->assistances->where('asistencia' ,'Inasistencia')->count()}} inasistencias</span></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer bg-white border-0 rounded-0">
                {{$users->links()}}
            </div>
        </div>
    @endif
</div>