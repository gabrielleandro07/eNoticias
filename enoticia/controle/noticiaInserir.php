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
// Check if file already exists
if (file_exists($target_file)) {
	echo "<script> alert('Desculpe, o arquivo já existe.'); </script>";
	$uploadOk = 0;
}
// Check file size
if ($_FILES["imagem"]["size"] > 500000) {
	echo "<script> alert('Desculpe, seu arquivo é muito grande.'); </script>";
	$uploadOk = 0;
}
// Allow certain file formats
if (
	$imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif"
) {
	echo "<script> alert('Desculpe, somente arquivos JPG, JPEG, PNG e GIF são permitidos.'); </script>";
	$uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	echo "<script> alert('Desculpe, seu arquivo não foi enviado.');document.location.href='../noticiaNovo.php'; </script>";
	
	// if everything is ok, try to upload file
} else {
	if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
		//echo "The file " . basename($_FILES["imagem"]["name"]) . " has been uploaded.";

		$titulo_noticia = $_POST['titulo'] or '';
		$conteudo_noticia = $_POST['descricao'] or '';
		$imagem = basename($_FILES["imagem"]["name"]) or '';

		$query = "INSERT INTO noticia (titulo_noticia,conteudo_noticia,imagem_noticia) VALUES ('$titulo_noticia','$conteudo_noticia','$imagem')";

		$result = mysqli_query($conn, $query);

		if (mysqli_affected_rows($conn) > 0) {
			header("Location: ../noticiaListar.php ");
		} else {
			echo "<script> alert('Ocorreu um erro ao inserir a Notícia.'); document.location.href='../noticiaNovo.php'; </script></script>";
		}
	} else {
		echo "<script> alert('Desculpe, houve um erro ao enviar seu arquivo.'); document.location.href='../noticiaNovo.php'; </script></script>";

	}
}
