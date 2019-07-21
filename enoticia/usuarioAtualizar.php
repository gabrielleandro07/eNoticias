<?php
include_once('includes/header.php');
include_once('includes/menu.php');
include('./controle/conexao.php');

if (!(isset($_SESSION['perfil']))) {
    header('Location:../noticia.php');
}

?>

<?php
$query = 'SELECT * FROM usuario WHERE id_usuario =' . $_GET['id'];
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// perfil
$perfil = " SELECT * FROM perfil ";
$result_perfil = mysqli_query($conn, $perfil);
?>
</head>


<main>
    <div class="container mt-5 card-header">
        <h1 class="mb-5">Atualização de Usuário</h1>
        <form action="controle/usuarioAlterar.php" method="POST">
            <div class="form-group">
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" name="id_usuario" value=<?php echo $row['id_usuario'] ?> readonly id="id">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="user">Usuário</label>
                        <input type="text" class="form-control" name="ds_usuario" value=<?php echo $row['ds_usuario'] ?> id="nm_usuario">
                    </div>

                    <div class="form-group col-md-7">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" name="nm_usuario" id="nm_usuario" value="<?php echo $row['nm_usuario'] ?>" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="datanascimento">Data de Inclusão</label>
                        <input type="date" disabled class="form-control" name="dt_inclusao" value=<?php echo $row['dt_inclusao'] ?> id="data-nascimento">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="ativo">Ativo</label>
                        <select name="fl_ativo" class="form-control">
                            <option value="1" <?php if ($row['fl_ativo'] == 1) {
                                                    echo ' selected ';
                                                } ?>>Ativo</option>
                            <option value="0" <?php if ($row['fl_ativo'] <> 1) {
                                                    echo ' selected ';
                                                } ?>>Inativo</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="perfil">Perfil</label>
                        <select name="id_perfil" class="form-control">
                            <?php
                            while ($row_perfil = mysqli_fetch_assoc($result_perfil)) {
                                echo '<option value="' . $row_perfil['id_perfil'] . '"';
                                if ($row['id_perfil'] == $row_perfil['id_perfil']) echo ' selected="selected" ';
                                echo '>' . $row_perfil['descricao'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="user">Alterar Senha de acesso</label>
                        <input type="password" class="form-control" name="senha" id="senha" maxlength="15">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" name="enviar">Atualizar</button>
        </form>
    </div>
</main>

<?php
include_once('./includes/footer.php');

?>