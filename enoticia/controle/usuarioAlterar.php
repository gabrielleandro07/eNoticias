<?php
    include_once('conexao.php');

	$id_usuario = $_POST['id_usuario'];
	$nm_usuario = $_POST['nm_usuario'] or '';
	$ds_usuario = $_POST['ds_usuario'] or '';
	$fl_ativo = $_POST['fl_ativo'] or 0;
	$id_perfil = $_POST['id_perfil'] or 2;
	$senha = $_POST['senha'] or '';

	$query = "UPDATE usuario SET nm_usuario = '$nm_usuario', ds_usuario='$ds_usuario', fl_ativo =$fl_ativo, id_perfil = $id_perfil WHERE id_usuario = $id_usuario ";

	echo $query;

	$result = mysqli_query($conn, $query);
	
	// atualiza senha
	if(strlen(trim($senha)) > 0){
		
		$senha = "UPDATE senha SET dt_expiracao = DATE_ADD(now(), INTERVAL 60 DAY), ds_senha_cripto = '".md5($senha)."' WHERE id_usuario = '$id_usuario' ";
		$result = mysqli_query($conn, $senha);
		
	}
	

	if (mysqli_affected_rows($conn) > 0){
		
	    $_SESSION['mensagem'] = '<div class="alert alert-primary" role="alert">Usuário atualizado com sucesso</div>';
		header("Location: ../usuarioListar.php ");
	}else{
	    $_SESSION['mensagem'] = '<div class="alert alert-danger" role="alert">Ocorreu um erro ao atualizar o usuário '.$query.'</div>';
	}

	
?>