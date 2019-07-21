<?php 
    include('./controle/conexao.php');
    include_once('includes/header.php');
    include_once('./includes/menu.php');
    if (!(isset($_SESSION['perfil']) && $_SESSION['perfil'] == '1')) {
        header('Location:noticia.php');
    }
?>


<main role="main bg-light">
<div class="container mt-5 card-header">
            <h1 class="mb-5">Cadastro de Usuário</h1>
            <form action="controle/usuarioInserir.php" method="POST">
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="ds_usuario">Usuário</label>
                            <input type="text" class="form-control" name="ds_usuario" id="ds_usuario">
                        </div>

                        <div class="form-group col-md-9">
                            <label for="nm_usuario">Nome</label>
                            <input type="text" class="form-control" name="nm_usuario" id="nm_usuario" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="dt_inclusao">Data de Inclusão</label>
                            <input type="date" class="form-control" name="dt_inclusao" id="dt_inclusao" value="<?php echo date('Y-m-d') ?>" readonly>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="fl_ativo">Ativo</label>
							   <select name="fl_ativo" class="form-control" >
									<option value="1">Ativo</option>
									<option value="0">Inativo</option>
								</select>
                        </div>
                        <?php
                            $perfil = " SELECT * FROM perfil ";
                            $result_perfil = mysqli_query($conn, $perfil);
                        ?>
                        <div class="form-group col-md-4">
                            <label for="id_perfil">Perfil</label>
                            <select name="id_perfil" class="form-control" >
								<?php
								while($row_perfil = mysqli_fetch_assoc($result_perfil)){
									echo '<option value="'.$row_perfil['id_perfil'].'">'.$row_perfil['descricao'].'</option>';
								}
								?>
							</select>
                        </div>
                    </div>
                </div>
				
				<div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="senha">Senha de acesso</label>
                            <input type="password" class="form-control" name="senha" id="senha" maxlength="15">
                        </div>
                    </div>
                </div>
				
                <button type="submit" class="btn btn-primary">Cadastrar</a>
            </form>
        </div>
        </main>

<?php include_once('includes/footer.php');?>

