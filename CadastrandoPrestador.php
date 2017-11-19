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
<body background = "plano.jpg">

<?php



	$nome= $_POST['nome'];
	$email= $_POST['email'];
	$senha = $_POST['senha'];
	$cpf = $_POST['cpf'];
	$telefone = $_POST['telefone'];

	$pontuacao = 0;

	if( $nome == NULL || $email == NULL || $senha == NULL || $telefone == NULL || $cpf == NULL ){
		echo "<script>alert('Favor preencher todos os campos')</script>";
		echo "<script>setTimeout(window.location='CadastroPrestador.php')</script>";
	}
	else{ 

		$sql = mysqli_query($conexao, "INSERT INTO prestador (nome,email,cpf,telefone,pontuacao,senha) VALUES ('$nome','$email','$cpf','$telefone','$pontuacao','$senha')");
		echo "<script>alert('Cadastrado com sucessos!')</script>";
		echo "<script>setTimeout(window.location='index.php')</script>";

		session_start();
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['senha'] = $_POST['senha'];
		$_SESSION['nome'] = $_POST['nome'];
		$_SESSION['cpf'] = $_POST['cpf'];
		$_SESSION['telefone'] = $_POST['telefone'];

		$_SESSION['pontuacao'] = $_POST['pontuacao'];
		$_SESSION['numerocc'] = $_POST['numerocc'];
}


?>

</body>
</html>