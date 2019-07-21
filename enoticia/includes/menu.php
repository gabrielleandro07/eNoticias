<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?php if(isset($_SESSION['nm_usuario'])): ?>
    <a class="navbar-brand" href="#"><b>Olá:</b> <?php echo $_SESSION['nm_usuario']; ?></a>
    <?php endif; ?>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mr-6" id="collapsibleNavId">
        <ul class="navbar-nav flex-collum ml-md-auto d-md-flex">
            <li class="nav-item active">
                <a class="nav-link" href="noticia.php"> Notícias </a>
            </li>
            <?php
            if ((isset($_SESSION['perfil']))) :
                ?>
                <li class="nav-item">
                    <?php
                        $cur_dir = explode('\\', getcwd());
                        if ($cur_dir[count($cur_dir) - 1] == 'controle') {
                    ?>
                        <a class="nav-link" href="../administracao.php">Administração</a>
                    <?php
                    } else {
                    ?>
                        <a class="nav-link" href="administracao.php">Administração</a>
                    <?php
                    }
                    ?>
                </li>
            <?php
            endif;
            ?>

            <li class="nav-item">
                <a class="nav-link" href="contato.php">Contato</a>
            </li>
            <?php
            if (!(isset($_SESSION['perfil']))) {
                ?>
                <li class="nav-item dropdown d-none d-lg-block d-xl-block">
                    <a class="nav-link btn btn-primary dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Login
                    </a>

                    <form class="dropdown-menu control-menu p-4" action="" method="POST">
                        <div class="form-group">
                            <label for="login">Usuário</label>
                            <input type="text" class="form-control" id="login" placeholder="Usuário" name="usuario">
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input type="password" class="form-control" id="senha" placeholder="Senha" name="senha">
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
        </ul>
    </div>
</nav>

<?php
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
    } else {
        echo "<script> alert('Usuário ou senha invalidos!'); </script>";
    }
    header("refresh: 0 ;");
} else if (isset($_POST['sair'])) {
    unset($_SESSION['nm_usuario']);
    unset($_SESSION['perfil']);
    // header("refresh: 0;");
    header('Location:./index.php');
}
?>