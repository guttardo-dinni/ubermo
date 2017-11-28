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

	if(!isset($_POST['nomeEnd']) || !isset($_POST['rua']) || !isset($_POST['numero']) || !isset($_POST['complemento']) || !isset($_POST['bairro']) || !isset($_POST['cidade']) || !isset($_POST['cep']) )
		header("Location: upload.php");

	//CONEXAO COM O BD
	include("config.php");

	$conexao = mysqli_connect($host, $user, $senha, $banco) or die(mysqli_error());

	mysqli_select_db($conexao, $banco);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Registro de endereço UBERMO</title>
</head>
<body background = "plano.jpg">

<?php


    $nomeEnd = $_POST['nomeEnd'];
	$rua= $_POST['rua'];
	$numero= $_POST['numero'];
	$complemento = $_POST['complemento'];
	$bairro = $_POST['bairro'];
	$cidade = $_POST['cidade'];
	$cep = $_POST['cep'];

	if( $rua == NULL || $numero == NULL || $complemento == NULL || $bairro == NULL || $cidade == NULL || $cep == NULL ){
		echo "<script>alert('Favor preencher todos os campos')</script>";
		echo "<script>setTimeout(window.location='registraendereco.php')</script>";
	}
	else if( preg_match('/\d+/', $rua)>0 ){
	   echo "<script>alert('Rua inválida')</script>";
	   echo "<script>setTimeout(window.location='registraendereco.php')</script>";
	}
	else if( preg_match('/\d+/', $bairro)>0 ){
	   echo "<script>alert('Rua inválida')</script>";
	   echo "<script>setTimeout(window.location='registraendereco.php')</script>";
	}
	else if( preg_match('/\d+/', $cidade)>0 ){
	   echo "<script>alert('Rua inválida')</script>";
	   echo "<script>setTimeout(window.location='registraendereco.php')</script>";
	}
	else{ 

		$sql = mysqli_query($conexao, "INSERT INTO endereco (nomeEnd, idcliente, rua, numero, complemento, bairro, cidade, cep) VALUES ('$nomeEnd','$idpessoa','$rua','$numero','$complemento','$bairro','$cidade','$cep')");
		echo "<script>alert('Endereço cadastrado com sucesso!')</script>";
		echo "<script>setTimeout(window.location='AbrirSolicitacao.php')</script>";
	}
?>

</body>
</html>

<br><center> <?php if($categoria == 1) { echo "Logado com Prestador ID$idpessoa - $email";} else if($categoria == 0) echo "Logado com Cliente ID$idpessoa - $email";?> <a href="logout.php"> [SAIR]</a>  </center>