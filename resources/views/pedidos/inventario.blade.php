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
    <span class="left">Inventário de materias
    </span> 
    <span class="right">
        Estoque apurado em,<?php date_default_timezone_set('America/Sao_Paulo');
        $date = date('d/m/Y H:i');
        echo $date; ?>
         </span> 
        </p>
   
        <h3>
            Origem do material: Departamento de Almoxarifado (SMEDU)
        </h3>
       



        </div>

        <table class="p1" style="width:100%">
            <tr>

                <th width="5%">Item</th>
                <th width="5%">Código</th>
                <th width="85%">Material</th>
                <th width="5%">Quant.</th>

            </tr>


            @foreach ($saidas as $saida)
                <tr>

                    <td style="text-align:center;">{{ $loop->iteration }}</td>
                    <td style="text-align:center;">{{ $saida->id ?? null }} </td>
                    <td>{{ $saida->nome ?? null }} </td>
                    <td style="text-align:center;">{{ $saida->saldo_atual ?? null }} </td>

                </tr>
            @endforeach

        </table>
       
</body>

</html>
