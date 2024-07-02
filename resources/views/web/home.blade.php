<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="pt-br">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema de Almoxarifado</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="{{ url('vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('vendors/themify-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ url('vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ url('vendors/selectFX/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ url('vendors/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/path/to/select2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">


    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Select2 dependencias -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>

    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Masck -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>


</head>

<body>


    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
                    aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src={{ url('images/logo.png') }} alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src={{ url('images/logo2.png') }} alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">

                    </li>
                    <h3 class="menu-title">Controle de Processos</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Processos</a>
                        <ul class="sub-menu children dropdown-menu">

                            <li><i class="fa fa-puzzle-piece"></i><a href="{{ url('/processo.index') }}">Processos
                                    Adm</a></li>



                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Ordens</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-puzzle-piece"></i><a href="{{ url('/ordem.index') }}">O.F.s</a></li>



                        </ul>
                    </li>


                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Fornecedores</a>
                        <ul class="sub-menu children dropdown-menu">

                            <li><i class="fa fa-id-badge"></i><a href="{{ url('/lista-fornecedor') }}">Fornecedores</a>
                            </li>



                        </ul>
                    </li>
                    <h3 class="menu-title">Movimentação de Materiais</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Gerenciar Materias</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-share-square-o"></i><a href="{{ url('/produto.index') }}">Ver Materias</a></li>
                                <li><i class="fa fa-share-square-o"></i><a href="{{ url('/produto.create') }}">Cadastrar</a></li>
                                <li><i class="fa fa-share-square-o"></i><a href="{{ url('/saidas.index') }}">Dar Saidas</a></li>
                                <li><i class="fa fa-share-square-o"></i><a href="{{ url('/pedidos.index') }}">Pedidos de compra</a></li>
                                <li><i class="fa fa-bars"></i><a href="ui-tabs.html">Gerenciar Categorias</a></li>

                            </ul>   

                    
                    </li>

                    
                 




                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                       
                       

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">{{$ja_vencida->count()+$vencimento_da_ordem->count()}} </span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">Você tem {{ $ja_vencida->count()+$vencimento_da_ordem->count()}} Ordens em aberto.</p>

                                Vencidas<i class="fa fa-check"></i> 
                                @foreach ($vencimento_da_ordem as $rs)
                                <a class="dropdown-item media bg-flat-color-1" href="#">
                                                                     
                                    Data da Emissão{{ date('d/m/Y', strtotime($rs->emissao))}} Vencimento {{Carbon\Carbon::parse($rs->emissao)->addDays(12)->format('d/m/Y')}} Número da ordem: {{ $rs->numero_ordem}} Fornecedor:{{ $rs->Fornecedores->nome_fantasia}} Processo:{{ $rs->Processo->numero}}<br> 
                                </a> 
                           @endforeach
                           A vencer<i class="fa fa-info"></i> 
                           @foreach ($ja_vencida as $resultado)
                                <a class="dropdown-item media bg-flat-color-4" href="#">
                                    
                                   Data da Emissão{{ date('d/m/Y', strtotime($resultado->emissao))}} Vencimento {{Carbon\Carbon::parse($resultado->emissao)->addDays(12)->format('d/m/Y')}} Número da ordem: {{ $resultado->numero_ordem}} Fornecedor:{{ $resultado->Fornecedores->nome_fantasia}}<br> 
                                </a>
                          @endforeach
                              
                            </div>
                        </div>

                       
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="{{ url('images/admin.jpg') }}"
                                alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa-user"></i>
                                {{ Auth::user()->name }}</a>

                            <a class="nav-link" href="#"><i class="fa fa-user"></i> Notifications <span
                                    class="count">13</span></a>

                            <a class="nav-link" href="{{ url('profile') }}"><i class="fa fa-cog"></i> Editar
                                Perfil</a>
                            <a class="nav-link" href="{{ url('logout') }}">

                                <i class="fa fa-power-off"></i> Sair</a>

                        </div>
                    </div>



                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        @yield('content')
    </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="{{ url('vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ url('vendors/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ url('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/js/main.js') }}"></script>


    <script src="{{ url('vendors/chart.js/dist/Chart.bundle.min.js') }}"></script>
    <script src="{{ url('assets/js/dashboard.js') }}"></script>
    <script src="{{ url('assets/js/widgets.js') }}"></script>
    <script src="{{ url('vendors/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ url('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ url('vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>



    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>


</body>

</html>
