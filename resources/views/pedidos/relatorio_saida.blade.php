<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <style>
        p {
            font-weight: bold;
            line-height: 0.50px;
        }

        table.p1 {
            border-collapse: collapse;
            border-spacing: 0px;
        }

        table,
        th,
        td {
            padding: 5px;
            border: 1px solid black;

        }

        table.p2 {
            background: white;
            border: none;
        }

        td.assinatura {
            border: none
        }

        .left {
            float: left;
            width: 50%;
        }

        .right {
            float: right;
            width: 50%;
            text-align: right;
        }
    </style>

</head>

<body>

    <img src='data:image/png;base64,{{ $image }}' align="left" width="40%" height="7%">

    <p align="center">ESTADO DO RIO DE JANEIRO</p>
    <p align="center">PREFEITURA MUNICIPAL DE ITAGUAÍ</p>
    <p align="center">Secretaria Municipal de Educação (SMEDU)</p>
    <p align="center">Departamento de Patrimônio e Almoxarifado</p>

    <hr>
    <p>
        <span class="left">Relatório de saidas por material.
        </span>
        <span class="right">
            Emitido em,<?php date_default_timezone_set('America/Sao_Paulo');
            $date = date('d/m/Y H:i');
            echo $date; ?>
        </span>
    </p>

    </div>

    <table class="p1" style="width:100%">
        <tr>

            <th width="80%">Material</th>
            <th width="10%">Unidade/Departamento</th>
            <th width="5%">Data da emissão</th>
            <th width="5%">Quant.</th>
        </tr>
        @foreach ($pedidos as $pedido)
            <tr>
                <td>{{ $pedido->Produto->nome_produto ?? null }} </td>
                <td>{{ $pedido->Unidades->nome_unidade ?? null }} </td>
                <td>{{ $pedido->created_at->format('d/m/Y H:i:s') }} </td>
                <td>{{ $pedido->quantidade ?? null }} </td>
            </tr>
        @endforeach

        <tr>
           <td colspan="4"  style="text-align:right" > Total de saídas:<strong>{{ $totalValor }}</strong></td>
        </tr>
    </table>

</body>

</html>
