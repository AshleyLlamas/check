<table>
    <thead>
        <tr>
            <th>Número de empleado</th>
            <th>Nombre</th>
            <th>Área / Proyecto</th>
            <th>Empresa / Compañia</th>
            <th>Centro de costos</th>
            <th>Fecha</th>
            <th>Hora de entrada</th>
            <th>Hora de salida</th>
            <th>Route</th>
        </tr>
    </thead>
    <tbody>
        @foreach($assistances as $assistance)
            <tr>
                <td>{{ $assistance->user->número_de_empleado }}</td>
                <td>{{ $assistance->user->name }}</td>
                <td>
                    @if($assistance->user->areas->count())
                        {{$assistance->user->areas->first()->área}}
                    @else
                        <span class="text-danger">N/A</span>
                    @endif
                </td>
                <td>
                    @isset($assistance->user->company)
                        {{$assistance->user->company->nombre_de_la_compañia}}
                    @else
                        <span class="text-danger">N/A</span>
                    @endisset
                </td>
                <td>
                    @isset($assistance->user->cost_center)
                        {{ $assistance->user->cost_center->folio }}
                    @else
                        N/A
                    @endisset
                </td>
                <td>
                    @isset($assistance->check)
                        {{$assistance->check->fecha->format('d/m/Y')}}
                    @endisset
                </td>
                <td>
                    @isset($assistance->check->in)
                        {{$assistance->check->in->hora->format('h:i:s A')}}
                    @endisset
                </td>
                <td>
                    @isset($assistance->check->out)
                        {{$assistance->check->out->hora->format('h:i:s A')}}
                    @endisset
                </td>
                <td>{{ route('admin.assistances.show', $assistance) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>