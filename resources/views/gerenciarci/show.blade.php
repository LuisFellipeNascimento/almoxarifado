<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Número da C.I</th>
            <th>Solicitante</th>
            <th>Descrição</th>
            <th>Status</th>
            <th>Data de Recebimento</th>
            <th>Data de Atendimento</th>
            <th>Data de Resposta</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($controle_ci as $rs)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $rs->numero_ci }}</td>
                <td>{{ $rs->unidades->nome_unidade }}</td>
                <td>{{ $rs->descricao }}</td>
                <td>{{ $rs->status }}</td>
                <td>{{ \Carbon\Carbon::parse($rs->recebimento_ci)->format('d/m/Y') }}</td>
                <td>{{ $rs->atendimento_ci ? \Carbon\Carbon::parse($rs->atendimento_ci)->format('d/m/Y') : '-' }}</td>
                <td>{{ $rs->data_resposta ? \Carbon\Carbon::parse($rs->data_resposta)->format('d/m/Y') : '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>