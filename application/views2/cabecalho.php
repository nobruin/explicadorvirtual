<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Reforço Escolar - Explicador Virtual</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- @todo: fill with your company info or remove -->
        <meta name="description" content="">
        <meta name="author" content="Themelize.me">

        <!-- Bootstrap CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Font Awesome -->
        <link href="{url}css/font-awesome.min.css" rel="stylesheet">

        <!-- Plugins required on all pages NOTE: Additional non-required plugins are loaded ondemand as of AppStrap 2.5 -->
        <!-- Plugin: animate.css (animated effects) - http://daneden.github.io/animate.css/ -->
        <link href="{url}plugins/animate/animate.css" rel="stylesheet">
        <!-- @LINEBREAK -- <!-- Plugin: flag icons - http://lipis.github.io/flag-icon-css/ -->
        <link href="{url}plugins/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">

        <!-- Theme style -->
        <link href="{url}css/theme-style.min.css" rel="stylesheet">

        <!--Your custom colour override-->
        <!--<link href="#" id="colour-scheme" rel="stylesheet">-->
        <link href="{url}css/colour-orange.css" rel="stylesheet">
        <!--<link href={url}css/colour-red.css" rel="stylesheet">-->

        <!-- Your custom override -->
        <link href="{url}css/custom-style.css" rel="stylesheet">
        
        <link href="{url}css/explicador_virtual.css" rel="stylesheet">

        <!-- HTML5 shiv & respond.js for IE6-8 support of HTML5 elements & media queries -->
        <!--[if lt IE 9]>
        <script src="{url}plugins/html5shiv/dist/html5shiv.js"></script>
        <script src="{url}plugins/respond/respond.min.js"></script>
        <![endif]-->

        <!-- Le fav and touch icons - @todo: fill with your icons or remove -->
        <link rel="shortcut icon" href="{url}img/icons/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{url}img/icons/114x114.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{url}img/icons/72x72.png">
        <link rel="apple-touch-icon-precomposed" href="{url}img/icons/default.png">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Rambla' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Calligraffitti' rel='stylesheet' type='text/css'>

        <!--Plugin: Retina.js (high def image replacement) - @see: http://retinajs.com/-->
        <script src="{url}plugins/retina/dist/retina.min.js"></script>
    </head>

    <!-- ======== @Region: body ======== -->
    <body class="page page-slider-revolution-full">
        <a href="#content" class="sr-only">Ir para o conteúdo</a> 

        <!-- ======== @Region: #navigation ======== -->
        <div id="navigation" class="wrapper margin-bottom-lg">
            <div class="navbar-static-top navbar-full-width">
                <!--Header upper region-->
                <div class="header-upper">
                    <div class="header-upper-inner container">
                        <div class="row">
                            <div class="col-xs-8 col-xs-push-4">

                                <!--Show/hide trigger for #hidden-header -->
                                <!--
                                <div id="header-hidden-link">
                                    <a href="#" title="Click me you'll get a surprise" class="show-hide" data-toggle="show-hide" data-target=".header-hidden" data-callback="searchFormFocus"><i></i>Open</a>
                                </div>
                                -->

                                <!--social media icons-->
                                <div class="social-media">
                                    <!--@todo: replace with company social media details-->
                                    <a href="#"> <i class="fa fa-twitter-square"></i> </a>
                                    <a href="#"> <i class="fa fa-facebook-square"></i> </a>
                                    <a href="#"> <i class="fa fa-linkedin-square"></i> </a>
                                    <a href="#"> <i class="fa fa-google-plus-square"></i> </a>
                                </div>
                            </div>
                            <div class="col-xs-4 col-xs-pull-8">
                                <!--user menu-->
                                <div class="btn-group user-menu">
                                    <a href="#login-modal" class="btn btn-link login-mobile" data-toggle="modal"><i class="fa fa-user"></i></a>
                                    <a href="#login-modal" class="btn btn-link login" data-toggle="modal">Entrar</a> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Header search region - hidden by default -->
                <div class="header-search">
                    <form class="search-form container">
                        <input type="text" name="search" class="form-control search" value="" placeholder="Buscar">
                        <button type="button" class="btn btn-link"><span class="sr-only">Buscar </span><i class="fa fa-search fa-flip-horizontal search-icon"></i></button>
                        <button type="button" class="btn btn-link close-btn" data-toggle="search-form-close"><span class="sr-only">Fechar </span><i class="fa fa-times search-icon"></i></button>
                    </form>
                </div>
                
                <!--Header & Branding region-->
                <div class="header" data-toggle="clingify"> 
                    <div class="header-inner container">
                        <div class="navbar">
                            <div class="pull-left">
                                <!--branding/logo-->
                                <a class="navbar-brand" href="{url}principal" title="Home">
                                    <h1>
                                       <img src="{url}img/logo_explicador.png" alt="Logotipo" width="110" />
                                    </h1>
                                </a>
                            </div>

                            <!--Search trigger -->
                            <!--<a href="#search" class="search-form-tigger" data-toggle="search-form" data-target=".header-search">
                                </span>
                                <i class="fa fa-search fa-flip-horizontal search-icon"></i>
                            </a>-->

                            <!-- mobile collapse menu button - data-toggle="toggle" = default BS menu - data-toggle="jpanel-menu" = jPanel Menu -->
                            <a href="#top" class="navbar-btn" data-toggle="jpanel-menu" data-target=".navbar-collapse" data-direction="right"><i class="fa fa-bars"></i></a>

                            <!--everything within this div is collapsed on mobile-->
                            <div class="navbar-collapse collapse">
                                <!--main navigation-->
                                <ul class="nav navbar-nav">
                                    <li class="home-link">
                                        <a href="{url}principal"><i class="fa fa-home"></i><span class="hidden">Início</span></a>
                                    </li>

                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" id="pages-drop" data-toggle="dropdown" data-hover="dropdown">SOBRE +</a> 
                                        <!-- Menu -->
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="pages-drop">
                                            <li><a href="javascript:;" class="menu-item">Quem Somos</a></li>                                            
                                            <li><a href="javascript:;" class="menu-item">Como Funciona</a></li>
                                            <li><a href="{url}professores" class="menu-item">Nossos Professores</a></li>
                                            <li><a href="{url}perguntas_frequentes" class="menu-item">Perguntas Frequentes</a></li>
                                            <li><a href="{url}fale_conosco" class="menu-item">Fale Conosco</a></li>
                                        </ul>
                                    </li>

                                    <li class="dropdown dropdown-full">
                                        <a href="#" class="dropdown-toggle menu-item" id="megamenu-drop" data-toggle="dropdown" data-hover="dropdown">Nossos Cursos +</a> 
                                        <!-- Dropdown Menu - Mega Menu -->
                                        <ul class="dropdown-menu mega-menu" role="menu" aria-labelledby="megamenu-drop">
                                            <li role="presentation" class="dropdown-header">Cursos disponíveis</li>
                                            <li role="presentation">
                                                <ul class="row list-unstyled" role="menu">
                                                    <li class="col-md-3" role="presentation">
                                                        <a role="menuitem" href="{url}cursos_sexto_ano" class="img-link">
                                                            <img src="{url}img/features/feature-1.png" alt="Curso 6º Ano" />
                                                        </a>
                                                        <a role="menuitem" href="{url}cursos_sexto_ano" tabindex="-1" class="menu-item"><strong>6º ano</strong></a>
                                                        <span>Aulas de alta qualidade ministradas por professores especialistas em seus assuntos.</span> 
                                                    </li>
                                                    <li class="col-md-3" role="presentation">
                                                        <a role="menuitem" href="{url}cursos_setimo_ano" class="img-link">
                                                            <img src="{url}img/features/feature-2.png" alt="Curso 7º ano" />
                                                        </a>
                                                        <a role="menuitem" href="{url}cursos_setimo_ano" tabindex="-1" class="menu-item"><strong>7º ano</strong></a>
                                                        <span>Aulas de alta qualidade ministradas por professores especialistas em seus assuntos.</span> 
                                                    </li>
                                                    <li class="col-md-3" role="presentation">
                                                        <a role="menuitem" href="features.htm" class="img-link">
                                                            <img src="{url}img/features/feature-3.png" alt="Curso 8º Ano" />
                                                        </a>
                                                        <a role="menuitem" href="features.htm" tabindex="-1" class="menu-item"><strong>8º ano</strong></a>
                                                        <span>Aulas de alta qualidade ministradas por professores especialistas em seus assuntos.</span> 
                                                    </li>
                                                    <li class="col-md-3" role="presentation">
                                                        <a role="menuitem" href="features.htm" class="img-link">
                                                            <img src="{url}img/features/feature-4.png" alt="Curso 9º ano" />
                                                        </a>
                                                        <a role="menuitem" href="features.htm" tabindex="-1" class="menu-item"><strong>9º ano</strong></a>
                                                        <span>Aulas de alta qualidade ministradas por professores especialistas em seus assuntos.</span> 
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" id="pages-drop" data-toggle="dropdown" data-hover="dropdown">BIBLIOTECA +</a> 
                                        <!-- Menu -->
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="pages-drop">
                                            <li><a href="{url}folclore" class="menu-item">Folclore Brasileiro</a></li>
                                            <li><a href="{url}datas_comemorativas" class="menu-item">Datas Comemorativas</a></li>    
                                            <li><a href="{url}mapas" class="menu-item">Mapas</a></li>                                         
                                        </ul>
                                    </li>

                                    <li class="dropdown">
                                        <a href="area_aluno/index.html" class="dropdown-toggle">ÁREA DO ALUNO</a> 
                                    </li>
                                </ul>
                            </div>
                            <!--/.navbar-collapse -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
