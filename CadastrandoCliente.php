<?php

	if(!isset($_POST['nome']) || !isset($_POST['email']) || !isset($_POST['senha']) || !isset($_POST['cpf']) || !isset($_POST['telefone']) )
		header("Location: index.php");


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
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	.w3-sidebar a {font-family: "Roboto", sans-serif}
	body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}
	body {
	    background-image: url("fundo.jpg");
	    background-color: #cccccc;
	}
</style>

<body class="w3-content" style="max-width:500px">

<?php



	$nome= $_POST['nome'];
	$email= $_POST['email'];
	$senha = $_POST['senha'];
	$cpf = $_POST['cpf'];
	$telefone = $_POST['telefone'];

	$foto = NULL;
	$pontuacao = 0;
	$numerocc = NULL;

	if( $nome == NULL || $email == NULL || $senha == NULL || $telefone == NULL || $cpf == NULL ){
		echo "<script>alert('Favor preencher todos os campos')</script>";
		echo "<script>setTimeout(window.location='CadastroCliente.php')</script>";
	}
	else{ 

		$sql = mysqli_query($conexao, "INSERT INTO cliente (nome,email,cpf,foto,pontuacao,telefone,numerocc,senha) VALUES ('$nome','$email','$cpf','$foto','$pontuacao','$telefone','$numerocc','$senha')");
		echo "<script>alert('Cadastrado com sucessos!')</script>";
		echo "<script>setTimeout(window.location='index.php')</script>";

		session_start();
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['senha'] = $_POST['senha'];
		$_SESSION['nome'] = $_POST['nome'];
		$_SESSION['cpf'] = $_POST['cpf'];
		$_SESSION['telefone'] = $_POST['telefone'];

		$_SESSION['foto'] = $_POST['foto'];
		$_SESSION['pontuacao'] = $_POST['pontuacao'];
		$_SESSION['numerocc'] = $_POST['numerocc'];
}


?>

</body>
</html>