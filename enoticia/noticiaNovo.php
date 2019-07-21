<?php

include_once('includes/header.php');
include('./controle/conexao.php');
include_once('./includes/menu.php');
if (!(isset($_SESSION['perfil']) && $_SESSION['perfil'] == '1')) {
    header('Location:noticia.php');
}
?>

<main role="main">
    <div class="container mt-3">

        <h2 class=" text-center mb-3">Notícias</h2>

        <form action="controle/noticiaInserir.php" method="POST" class="w-75 mx-auto border p-4" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="titulo">Titulo</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo">
                </div>
                <div class="form-group col-md-6">
                    <label for="descricao">Descrição</label>
                    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição">
                </div>
            </div>
            <div class="form-group">
                <label for="imagem">Selecione uma imagem</label>
                <input type="file" class="form-control-file" id="imagem" name="imagem">
            </div>
        
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</main>

<?php
include_once('./includes/footer.php')
?>