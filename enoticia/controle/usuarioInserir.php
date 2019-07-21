<?php
	include('./conexao.php');

	$nm_usuario = $_POST['nm_usuario'] or '';
	$ds_usuario = $_POST['ds_usuario'] or '';
	$fl_ativo = $_POST['fl_ativo'] or 0;
	$id_perfil = $_POST['id_perfil'] or 2;
	$senha = md5($_POST['senha']);

	$query = "INSERT INTO usuario (nm_usuario,ds_usuario,dt_inclusao,fl_ativo,id_perfil) VALUES ('$nm_usuario','$ds_usuario',now(),$fl_ativo,$id_perfil)";

	$result = mysqli_query($conn, $query);
	print_r ($result);
	if (isset($result)){
	   // $_SESSION['mensagem'] = '<div class="alert alert-primary" role="alert">Usuário cadastrado com sucesso</div>';
	
		// cadastra a senha
		$query = " INSERT INTO senha (dt_inclusao, dt_expiracao, id_usuario, ds_senha_cripto) VALUES (now(), DATE_ADD(now(), INTERVAL 60 DAY), (SELECT MAX(id_usuario) FROM usuario), '$senha') ";
		$result = mysqli_query($conn, $query);
		header("Location: ../usuarioListar.php");
	}else{
	  //  $_SESSION['mensagem'] = '<div class="alert alert-danger" role="alert">Ocorreu um erro ao inserir o usuário</div>';
	}
?>
