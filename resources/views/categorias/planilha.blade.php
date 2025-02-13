<table>
    <thead>
        <tr>
            <th>Nome das categorias</th>
           
        </tr>
    </thead>
    <tbody>
        @foreach($categorias as $categoria)
            <tr>
                <td>{{ $categoria->nome_categoria }}</td>
              
            </tr>
        @endforeach
    </tbody>
</table>