<table>
    <thead>
        <tr>
            <th>Nome</th>
           
        </tr>
    </thead>
    <tbody>
        @foreach($unidades as $unidade)
            <tr>
                <td>{{ $unidade->nome_unidade }}</td>
              
            </tr>
        @endforeach
    </tbody>
</table>