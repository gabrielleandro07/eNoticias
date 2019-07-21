<?php
include_once('./includes/header.php');
include_once('./includes/menu.php');

if (!isset($_SESSION['perfil'])) {
    header("location: noticia.php");
    exit();
}
?>

<div class="container mt-5 card-header">
    <h1>Lista de Usuários</h1>
    <?php if ($_SESSION['perfil'] == 1) { ?>
        <a class="btn btn-primary mb-2 float-right" href="usuarioNovo.php" role="button"><i class="fa fa-plus" aria-hidden="true"></i>
            Cadastrar
        </a>
    <?php } ?>
    <table class="table w-75 mx-auto mt-3 table-hover table-striped">
        <thead class="thead-dark text-center">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Usuário</th>
                <th scope="col">Data Inclusão</th>
                <th scope="col">Ativo</th>
                <th scope="col">Id Perfil</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php include_once('controle/usuarioSelecionar.php'); ?>
        </tbody>
    </table>

</div>
<?php include_once('includes /footer.php');?>