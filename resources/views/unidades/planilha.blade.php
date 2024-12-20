<table>
    <thead>
        <tr>
            <th>Nome</th>
           
        </tr>
    </thead>
    <tbody>
        @foreach($unidades as $user)
            <tr>
                <td>{{ $user->nome }}</td>
              
            </tr>
        @endforeach
    </tbody>
</table>