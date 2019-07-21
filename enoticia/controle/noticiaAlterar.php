<?php
include('conexao.php');

$target_dir = dirname(__FILE__, 2) . "\images\\";
$target_file = $target_dir . basename($_FILES["imagem"]["name"]);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
	$check = getimagesize($_FILES["imagem"]["tmp_name"]);
	if ($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	} else {
		echo "<script> alert('Arquivo não é uma imagem.'); </script>";
		$uploadOk = 0;
	}
}
// // Check if file already exists
// if (file_exists($target_file)) {
// 	echo "<script> alert('Desculpe, o arquivo já existe.'); </script>";
// 	$uploadOk = 0;
// }
// Check file size
if ($_FILES["imagem"]["size"] > 500000) {
	echo "<script> alert('Desculpe, seu arquivo é muito grande.'); </script>";
	$uploadOk = 0;
}

$ok =0;
// Allow certain file formats
if (
	$imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" && $imageFileType != ''
) {
	echo "<script> alert('Desculpe, somente arquivos JPG, JPEG, PNG e GIF são permitidos.'); </script>";
	$uploadOk = 0;
	$ok=0;
}else{
	$ok=1;
}
// Check if $uploadOk is set to 0 by an error
		//$imagem = '';
		$titulo_noticia = $_POST['titulo'] or '';
		$conteudo_noticia = $_POST['descricao'] or '';
		if($imageFileType != '' && ($ok ==1)){
			move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file);
			unlink(($target_dir.$_POST['temp_image']));
			$imagem = basename($_FILES["imagem"]["name"]); 
		}
		 if($imagem == ''){
			$imagem = $_POST['temp_image'];
		 }
		 $id = $_POST['id'];
		$query = "UPDATE noticia set titulo_noticia = '$titulo_noticia', conteudo_noticia='$conteudo_noticia', imagem_noticia='$imagem' WHERE id_noticia = $id";

		$result = mysqli_query($conn, $query);

		header("Location: ../noticiaListar.php ");
		// if (mysqli_affected_rows($conn) > 0) {
		// 	header("Location: ../noticiaListar.php ");
		// } else {
		// 	echo "<script> alert('Ocorreu um erro ao atualizar a Notícia.'); document.location.href='../noticiaListar.php'; </script></script>";
		// }
	