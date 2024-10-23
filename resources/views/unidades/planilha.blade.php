<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($unidades as $user)
            <tr>
                <td>{{ $user->nome }}</td>
                <td>[     ]</td>
            </tr>
        @endforeach
    </tbody>
</table>