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
                {
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
    <span class="left">Recibo número: @foreach ($pedidos->unique('codigo_pedido') as $pedido)
            {{ $pedido->codigo_pedido }}
        @endforeach
    </span> 
    <span class="right">
        Emitido em Itaguaí,<?php date_default_timezone_set('America/Sao_Paulo');
        $date = date('d/m/Y H:i');
        echo $date; ?>
         </span> 
        </p>
   
        <h3>
            Origem do material: Departamento de Almoxarifado (SMEDU)
        </h3>
        <h3>
            Local de entrega:
            @foreach ($pedidos->unique('id_unidades') as $pedido)
                {{ $pedido->unidades->nome_unidade }}
            @endforeach
        </h3>



        </div>

        <table class="p1" style="width:100%">
            <tr>

                <th width="5%">Item</th>
                <th width="5%">Código</th>
                <th width="80%">Material</th>
                <th width="5%">Quantidade</th>
                <th width="5%">Vencimento</th>

            </tr>


            @foreach ($pedidos as $pedido)
                <tr>

                    <td style="text-align:center;">{{ $loop->iteration }}</td>
                    <td style="text-align:center;">{{ $pedido->Produto->id ?? null }} </td>
                    <td>{{ $pedido->Produto->nome_produto ?? null }} </td>
                    <td style="text-align:center;">{{ $pedido->quantidade ?? null }} </td>
                    <td style="text-align:center;">
                    @if(date( 'd/m/Y' , strtotime( $pedido->Produto->vencimento)) == "31/12/1969")
                     Indeterminada
                    @else
                     {{ date( 'd/m/Y' , strtotime( $pedido->Produto->vencimento)) }} </td>
                     @endif
                </tr>
            @endforeach

        </table>
        <table class="p2" style="width:100%">

            <tr>
                <td scope="col" class="assinatura">Identificação do remetente</td>
                <td scope="col" class="assinatura" align ="center" colspan="3">Data de recebimento</td>
                <td scope="col" class="assinatura"align="right">Identificação do recebedor</td>



            </tr>

            <tr>
                <td scope="col" class="assinatura" align ="left">{{ Auth::user()->name }}</td>
                <td scope="col" class="assinatura"align="center" colspan="3">______/______/_____________</td>

                <td scope="col" class="assinatura"align="right">Nome:____________________</td>


            </tr>




            <tr>

                <td scope="col" class="assinatura"align="left">Matrícula:____________</td>
                <td scope="col" class="assinatura"></td>
                <td scope="col" class="assinatura"></td>
                <td scope="col" class="assinatura" align ="right" colspan="3">Matrícula:____________</td>

            </tr>


        </table>

        <hr>
    <br>
    <img src='data:image/png;base64,{{ $image }}' align="left" width="40%" height="7%">

    <p align="center">ESTADO DO RIO DE JANEIRO</p>
    <p align="center">PREFEITURA MUNICIPAL DE ITAGUAÍ</p>
    <p align="center">Secretaria Municipal de Educação (SMEDU)</p>
    <p align="center">Departamento de Patrimônio e Almoxarifado</p>

    <hr>
   <p>
    <span class="left">Recibo número: @foreach ($pedidos->unique('codigo_pedido') as $pedido)
            {{ $pedido->codigo_pedido }}
        @endforeach
    </span> 
    <span class="right">
        Emitido em Itaguaí,<?php date_default_timezone_set('America/Sao_Paulo');
        $date = date('d/m/Y H:i');
        echo $date; ?>
         </span> 
        </p>
   
        <h3>
            Origem do material: Departamento de Almoxarifado (SMEDU)
        </h3>
        <h3>
            Local de entrega:
            @foreach ($pedidos->unique('id_unidades') as $pedido)
                {{ $pedido->unidades->nome_unidade }}
            @endforeach
        </h3>



        </div>

        <table class="p1" style="width:100%">
            <tr>

                <th width="5%">Item</th>
                <th width="5%">Código</th>
                <th width="80%">Material</th>
                <th width="5%">Quantidade</th>
                <th width="5%">Vencimento</th>

            </tr>


            @foreach ($pedidos as $pedido)
                <tr>

                    <td style="text-align:center;">{{ $loop->iteration }}</td>
                    <td style="text-align:center;">{{ $pedido->Produto->id ?? null }} </td>
                    <td>{{ $pedido->Produto->nome_produto ?? null }} </td>
                    <td style="text-align:center;">{{ $pedido->quantidade ?? null }} </td>
                    <td style="text-align:center;">
                    @if(date( 'd/m/Y' , strtotime( $pedido->Produto->vencimento)) == "31/12/1969")
                     Indeterminada
                    @else
                     {{ date( 'd/m/Y' , strtotime( $pedido->Produto->vencimento)) }} </td>
                     @endif
                </tr>
            @endforeach

        </table>
        <table class="p2" style="width:100%">

            <tr>
                <td scope="col" class="assinatura">Identificação do remetente</td>
                <td scope="col" class="assinatura" align ="center" colspan="3">Data de recebimento</td>
                <td scope="col" class="assinatura"align="right">Identificação do recebedor</td>



            </tr>

            <tr>
                <td scope="col" class="assinatura" align ="left">{{ Auth::user()->name }}</td>
                <td scope="col" class="assinatura"align="center" colspan="3">______/______/_____________</td>

                <td scope="col" class="assinatura"align="right">Nome:____________________</td>


            </tr>




            <tr>

                <td scope="col" class="assinatura"align="left">Matrícula:____________</td>
                <td scope="col" class="assinatura"></td>
                <td scope="col" class="assinatura"></td>
                <td scope="col" class="assinatura" align ="right" colspan="3">Matrícula:____________</td>

            </tr>


        </table>

</body>

</html>
