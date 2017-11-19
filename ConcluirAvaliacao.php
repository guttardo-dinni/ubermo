<?php
	//CARREGA A SESSÃO PRA PRÓXIMA PÁGINA
	session_start();
	if(!isset($_SESSION["email"]) || !isset($_SESSION["senha"]) ){
		header("Location: index.php");
		exit;		
	}

	else{
		$idpessoa = $_SESSION['idpessoa'];
		$email= $_SESSION['email'];
		$categoria= $_SESSION['categoria']; 
	}

	if(!isset($_POST['idservico']) || !isset($_POST['nota']) || !isset($_POST['comentario']))
		header("Location: upload.php");

	//CONEXAO COM O BD
	$host = "localhost";
	$user = "root";
	$senha = "";
	$banco = "trabalho";

	$conexao = mysqli_connect($host, $user, $senha, $banco) or die(mysqli_error());

	mysqli_select_db($conexao, $banco);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Sistema de Cadastro UBERMO</title>
</head>
<body background = "plano.jpg">

<?php

	$dataAMD = date("Y-m-d"); //FUNÇÃO QUE PEGA A DATA ATUAL PARA REPRESENTAR O DIA QUE TERMINOU A SOLICITAÇÃO

	$nota= $_POST['nota'];
	$comentario= $_POST['comentario'];
	$idservico = $_POST['idservico'];

	$query = sprintf("SELECT * FROM solicitacao WHERE idsolicitacao='$idservico'"); // TODAS AS SOLICITAÇÕES QUE JÁ FORAM CONCLUIDAS (Logado como cliente)

	$dados = mysqli_query($conexao, $query) or die(mysql_error());

	$linha = mysqli_fetch_assoc($dados);


	if( $nota == NULL || $comentario == NULL || $idservico == NULL || $nota < 1 || $nota > 5 ){
		echo "<script>alert('Favor preencher todos os campos com dados válidos')</script>";
		echo "<script>setTimeout(window.location='upload.php')</script>";
	}
	else{ 

		if($categoria == 1){	//PRESTADOR

			if ($linha['notaproprestador'] == 0 ){
				$sql = mysqli_query($conexao, "UPDATE solicitacao SET dataAMD='$dataAMD', notaprocliente='$nota',comprestador ='$comentario' WHERE idsolicitacao = '$idservico'");
				echo "<script>alert('Avaliação feita com sucesso!')</script>";
				echo "<script>setTimeout(window.location='upload.php')</script>";
			}
			else {
				$sql = mysqli_query($conexao, "UPDATE solicitacao SET notaprocliente='$nota',comprestador ='$comentario',efetuado='1' WHERE idsolicitacao = '$idservico'");
				echo "<script>alert('Avaliação feita com sucesso!')</script>";
				echo "<script>setTimeout(window.location='upload.php')</script>";
			}
		}
		else if($categoria == 0){	//CLIENTE

			if ($linha['notaprocliente'] == 0 ){
				$sql = mysqli_query($conexao, "UPDATE solicitacao SET dataAMD='$dataAMD', notaproprestador='$nota',comcliente ='$comentario' WHERE idsolicitacao = '$idservico'");
				echo "<script>alert('Avaliação feita com sucesso!')</script>";
				echo "<script>setTimeout(window.location='upload.php')</script>";
			}
			else {
				$sql = mysqli_query($conexao, "UPDATE solicitacao SET notaproprestador='$nota',comcliente ='$comentario',efetuado='1' WHERE idsolicitacao = '$idservico'");
				echo "<script>alert('Avaliação feita com sucesso!')</script>";
				echo "<script>setTimeout(window.location='upload.php')</script>";
			}
		}
}

?>

</body>
</html>

<br><center> <?php if($categoria == 1) { echo "Logado com Prestador ID$idpessoa - $email";} else if($categoria == 0) echo "Logado com Cliente ID$idpessoa - $email";?> <a href="logout.php"> [SAIR]</a>  </center>