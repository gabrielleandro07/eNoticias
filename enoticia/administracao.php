<?php
include_once('./includes/header.php');
include_once('./includes/menu.php');
if (!(isset($_SESSION['perfil']))) {
    header('Location:index.php');
}
?>

<main role="main bg-light">

    <div class="py-5">
        <div class="container">
            <div class="row p-0 d-flex justify-content-around">
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm border-1 bg-white overflow rounded-0">
                        <div class="card-body">
                            <p class="card-title" style="font-weight: bold;">Usuário</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <?php
                                        if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == '1') :
                                    ?>
                                    <a class="btn btn-primary" href="usuarioNovo.php">Cadastrar</a>
                                    <?php
                                        endif;
                                    ?>
                                    <a class="btn btn-primary" href="usuarioListar.php">Gerenciar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == '1') :
                ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm border-1 bg-white overflow rounded-0">
                        
                        <div class="card-body">
                            <p class="card-title" style="font-weight: bold;">Notícia</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a class="btn btn-primary" href="noticiaNovo.php">Cadastrar</a>
                                    <a class="btn btn-primary" href="noticiaListar.php">Gerenciar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    endif;
                 ?>
            </div>
        </div>
    </div>
</main>

<?php include_once('includes/footer.php'); ?>
