<?php
    include_once('includes/header.php');
    include('./controle/conexao.php');
    include_once('./includes/menu.php');
    if (!(isset($_SESSION['perfil']) && $_SESSION['perfil'] == '1')) {
        header('Location:./noticia.php');
    }
?>
<?php
    $query = 'SELECT * FROM noticia WHERE id_noticia =' . $_GET['id'];
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
?>

</head>
<main role="main">
    <div class="container mt-3">

        <h2 class=" text-center mb-3">Alterar Notícia</h2>

        <form action="controle/noticiaAlterar.php" method="POST" class="w-75 mx-auto border p-4" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="titulo">Título</label>
                    <input type="text" class="form-control" id="titulo" value="<?php echo  utf8_encode ($row['titulo_noticia']) ?>" name="titulo" placeholder="Titulo">
                </div>
                <div class="form-group col-md-6">
                    <label for="descricao">Descrição</label>
                    <input type="text" class="form-control" id="descricao" value="<?php echo  utf8_encode ($row['conteudo_noticia']) ?>" name="descricao" placeholder="Descrição">
                </div>
            </div>
            <img src="./images/<?php echo $row['imagem_noticia'];?>" alt="" class="img-fluid" width="250">
            <div class="form-group">
                <label for="imagem">Selecione uma imagem</label>
                <input type="file" class="form-control-file" id="imagem" name="imagem">
                <input type="hidden" name="temp_image" value="<?php echo $row['imagem_noticia'];?>">
            </div>
            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</main>

<?php
    include_once('./includes/footer.php')
?>