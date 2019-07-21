<?php

$target_dir = dirname(__FILE__, 2) . "\images\\";
$target_file = $target_dir . $_GET['image'];
if (file_exists($target_file)) {
    if (unlink($target_file)) {
        deletar();
    } else {
        echo "<script> alert('Ocorreu um erro ao deletar a imagem');document.location.href='../noticiaListar.php'; </script>";
    }
} else {
    deletar();
}

function deletar()
{
    include('conexao.php');
    $id = $_GET['id'];
    // excluir noticia pelo id
    $query = "DELETE FROM noticia WHERE id_noticia=$id;";
    $result = mysqli_query($conn, $query);

    if (isset($result)) {
        header("Location: ../noticiaListar.php");
    } else {
        echo "<script> alert('Ocorreu um erro ao deletar a noticia');document.location.href='../noticiaListar.php'; </script>";
    }
}
