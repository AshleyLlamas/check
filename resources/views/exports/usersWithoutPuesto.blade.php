<table>
    <thead>
        <tr>
            <th># (ID)</th>
            <th>Número de empleado</th>
            <th>Nombre</th>
            <th>Puesto</th>
            <th>Empresa / Compañia</th>
            <th>Route</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->número_de_empleado }}</td>
                <td>{{ $user->name }}</td>
                <td>
                    @isset($user->puesto)
                        {{$user->puesto}}
                    @else
                        N/A
                    @endisset
                </td>
                <td>
                    @isset($user->company_id)
                        {{ $user->company->nombre_de_la_compañia }}
                    @else
                        N/A
                    @endisset
                </td>
                <td>{{ route('admin.users.show', $user) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>