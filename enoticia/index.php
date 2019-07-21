<?php
include_once('./includes/header.php');
include('./controle/conexao.php');
?>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        /*
        * Globals
        */

        /* Links */
        a,
        a:focus,
        a:hover {
            color: #fff;
        }

        /* Custom default button */
        .btn-secondary,
        .btn-secondary:hover,
        .btn-secondary:focus {
            color: #333;
            text-shadow: none;
            /* Prevent inheritance from `body` */
            background-color: #fff;
            border: .05rem solid #fff;
        }


        /*
        * Base structure
        */

        html,
        body {
            height: 100%;
            background-color: #333;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            color: #fff;
            text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5);
            box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
        }

        .cover-container {
            max-width: 42em;
        }


        /*
        * Header
        */
        .masthead {
            margin-bottom: 2rem;
        }

        .masthead-brand {
            margin-bottom: 0;
        }

        /* .nav-masthead .nav-link {
            padding: .25rem 0;
            font-weight: 700;
            color: rgba(255, 255, 255, .5);
            background-color: transparent;
            border-bottom: .25rem solid transparent;
        }

        .nav-masthead .nav-link:hover,
        .nav-masthead .nav-link:focus {
            border-bottom-color: rgba(255, 255, 255, .25);
        }

        .nav-masthead .nav-link+.nav-link {
            margin-left: 1rem;
        }*/

        .nav-masthead .active {
            color: #fff;
            border-bottom-color: #fff;
        }

        @media (min-width: 48em) {
            .masthead-brand {
                float: left;
            }

            .nav-masthead {
                float: right;
            }
        } 


        /*
        * Cover
        */
        .cover {
            padding: 0 1.5rem;
        }

        .cover .btn-lg {
            padding: .75rem 1.25rem;
            font-weight: 700;
        }


        /*
        * Footer
        */
        .mastfoot {
            color: rgba(255, 255, 255, .5);
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="cover.css" rel="stylesheet">
</head>

<body class="text-center" style="background-image: url('images/home-bg.jpg')">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
                <!-- <h3 class="masthead-brand">Portal de Notícias</h3> -->
                <nav class="nav nav-masthead justify-content-center">
                <li class="nav-item">
                <?php
                    if ((isset($_SESSION['perfil']))) :
                ?>
                        <a class="nav-link" href="./administracao.php">Administração</a>
                    <?php
                     endif;
                    ?>
                </li>
                <?php
            if (!(isset($_SESSION['perfil']))) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary dropdown-toggle  pull-right" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Login
                        </a>
                        <form class="dropdown-menu p-4" action="" method="POST">
                            <div class="form-group">
                                <label for="usuario">Usuário</label>
                                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuário">
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha">
                            </div>
                            <button type="submit" class="btn btn-primary" name="login">Entrar</button>
                        </form>
                    </li>
                    <li class="nav-item dropdown d-xs-block d-sm-block d-md-block d-lg-none">
                    <a class="nav-link btn btn-primary dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Login
                    </a>


                    <form class="dropdown-menu p-4" action="" method="POST">
                        <div class="form-group">
                            <label for="usuario">Usuário</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuário">
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
                        </div>
                        <button type="submit" class="btn btn-primary" name="login">Entrar</button>
                    </form>

                </li>
                    <li class="nav-item dropdown active"></li>
                    <?php
            } else {
                ?>
                <li class="nav-item">
                    <form action="" method="POST">
                        <button type="submit" class="btn btn-primary" name="sair">Sair</button>
                    </form>
                </li>
            <?php
            }
            ?>
                </nav>
            </div>
        </header>

        <main role="main" class="inner cover">
            <h1 class="cover-heading" style="font-size: 50px; font-weight: bold;">E-notícias, tudo ao seu alcance</h1>
            <p class="lead" style="font-size: 25px; font-weight: bold;">Últimas notícias de tecnologia em notebooks e eletronicos do Brasil e do mundo.</p>
            <p class="lead">
                <a href="noticia.php" class="btn btn-lg btn-secondary">Ver notícias</a>
            </p>
        </main>

        <footer class="mastfoot mt-auto">
            <div class="inner">
                <p style="font-size: 15px; color: black;"><strong>E-notícias</strong> - Brasil e do Mundo</p>
            </div>
        </footer>
    </div>
</body>

</html>
<?php
include_once('./includes/footer.php');
if (isset($_POST['login'])) {
    $login = $_POST['usuario'];
    $senha = md5($_POST['senha']);

    $conn = mysqli_connect('localhost', 'root', '', 'db_gabriel_leandro') or die('Ocorreu um erro ao conectar com o banco de dados');
    $query = "SELECT `id_perfil`,`nm_usuario` FROM `usuario`,`senha` WHERE `ds_usuario` = '$login' AND `ds_senha_cripto`= '$senha' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $user_perfil = mysqli_fetch_array($result);

    if (isset($user_perfil)) {
        $_SESSION['nm_usuario'] = $user_perfil['nm_usuario'];
        $_SESSION['perfil'] = $user_perfil['id_perfil'];
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        echo "<script> alert('Usuário ou senha invalidos!'); </script>";
    }
} else if (isset($_POST['sair'])) {
    unset($_SESSION['nm_usuario']);
    unset($_SESSION['perfil']);
    echo "<script>window.location.href = 'index.php';</script>";
}


?>