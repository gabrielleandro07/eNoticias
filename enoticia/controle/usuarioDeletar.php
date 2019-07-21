<?php
	
	include('conexao.php');
	
	$id = $_POST['id'];
	
	// exclui a senha
	$query_senha = "DELETE FROM senha WHERE id_usuario=$id;";
	$result_senha = mysqli_query($conn, $query_senha);
	
	// exclui o usuario
	$query = "DELETE FROM usuario WHERE id_usuario=$id;";
	$result = mysqli_query($conn, $query);

	if (isset($result)){
	    $_SESSION['mensagem'] = '<div class="alert alert-primary" role="alert">Usuário deletado com sucesso</div>';	
		header("Location: ../usuarioListar.php");
	}else{
	    $_SESSION['mensagem'] = '<div class="alert alert-danger" role="alert">Ocorreu um erro ao deletar o usuário</div>';
	}
	
?>