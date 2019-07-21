<?php 
    include('./controle/conexao.php');
    include_once('includes/header.php');
    include_once('./includes/menu.php');
    if (!(isset($_SESSION['perfil']) && $_SESSION['perfil'] == '1')) {
        header('Location:noticia.php');
    }
?>

 <main role="main">
     <div class="container mt-3">

         <h2 class=" text-center mb-3">Notícias</h2>

         <form action="noticiaNovo.php" method="" class="w-75 mx-auto border p-4">
             <button type="submit" class="btn btn-primary">Inserir Notícias</button>
         </form>
         <table class="table w-75 mx-auto mt-3 table-hover table-striped">
             <thead class="thead-dark text-center">
                 <tr>
                     <th scope="col">#</th>
                     <th scope="col">Título</th>
                     <th scope="col">Descrição</th>
                     <th scope="col">Imagem</th>
                     <th scope="col">Ação</th>
                 </tr>
             </thead>
             <tbody class="text-center">
             <?php 
                $noticia = " SELECT * FROM noticia";
                $result_noticia = mysqli_query($conn, $noticia);

            ?>
            <?php 
                $i=1;
                while($row_noticia = mysqli_fetch_assoc($result_noticia)){
            ?>
                 <tr>
                     <th scope="row"><?php echo $i++;?></th>
                     <td><?php echo  utf8_encode ($row_noticia['titulo_noticia']);?></td>
                     <td><?php echo  utf8_encode ($row_noticia['conteudo_noticia']);?></td>
                     <td><img src="images/<?php echo $row_noticia['imagem_noticia'];?>" alt="" class="img-fluid" width="250"></td>
                     <td>
                         <a href="controle/noticiaDeletar.php?id=<?php echo $row_noticia['id_noticia'];?>&image=<?php echo $row_noticia['imagem_noticia'];?>" class="btn btn-danger">Excluir</a>
                         <a href="noticiaAtualizar.php?id=<?php echo $row_noticia['id_noticia'];?>" class="btn btn-warning">Alterar</a>
                     </td>
                 </tr>
            <?php 
            
                }
            ?>

             </tbody>
         </table>

     </div>
 </main>

 <?php
    include_once('./includes/footer.php')
?>