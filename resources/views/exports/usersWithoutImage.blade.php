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
                <td>{{ $user->puesto }}</td>
                <td>
                    @isset($user->company_id)
                        {{ $user->company->nombre }}
                    @endisset
                </td>
                <td>{{ route('admin.users.show', $user) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>