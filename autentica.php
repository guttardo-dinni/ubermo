<?php


	if(!isset($_POST['email']) || !isset($_POST['senha']) )
		header("Location: index.php");

	if(!isset($_POST['tipoconta']) || $_POST['tipoconta'] < 1 || $_POST['tipoconta'] > 2)
		header("Location: index.php");
	
	include("config.php");

	$conexao = mysqli_connect($host, $user, $senha, $banco) or die(mysqli_error());

	mysqli_select_db($conexao, $banco);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Sistema de Login</title>
	<script type="text/javascript">
		function loginsuccessfully(){
			setTimeout("window.location='upload.php'", 50);
		}

		function loginfailed(){
			setTimeout("window.location='index.php'", 50);
		}
	</script>

</head>
<body background = "plano.jpg">

<?php

	$email= $_POST['email'];
	$senha = $_POST['senha'];
	$tipoconta = $_POST['tipoconta'];
	
	$row = 0;
	$row2 = 0;
	
	if($tipoconta == 1){
		$sql = mysqli_query($conexao, "SELECT * FROM cliente WHERE email='$email' and senha='$senha'") or die(mysqli_error());
		$row = mysqli_num_rows($sql);
	}
	else{
		$sql2 = mysqli_query($conexao, "SELECT * FROM prestador WHERE email='$email' and senha='$senha'") or die(mysqli_error());
		$row2 = mysqli_num_rows($sql2);
	}
	
	


	if($row2 > 0){ // AQUI É UM PRESTADOR

			$idpessoa = mysqli_query($conexao, "SELECT idprestador FROM prestador WHERE email='$email' and senha='$senha'") or die(mysqli_error());

			session_start();
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['senha'] = $_POST['senha'];

			$query = sprintf("SELECT * FROM prestador WHERE email='$email' and senha='$senha'");

			$dados = mysqli_query($conexao, $query) or die(mysql_error());
			$linha = mysqli_fetch_assoc($dados);
			$idpessoa = $linha['idprestador'];

			$_SESSION['idpessoa'] = $idpessoa;
			$_SESSION['categoria'] = 1;

			$_SESSION['foto'] = $linha['foto'];
			$_SESSION['nome'] = $linha['nome'];
			$_SESSION['cpf'] = $linha['cpf'];
			$_SESSION['telefone'] = $linha['telefone'];
			$_SESSION['cartao'] = $linha['numerocc'];

			//$_SESSION['idcliente'] = $_POST['idcliente'];
			echo "<script>alert('Logado como Prestador')</script>";
			echo "<script>loginsuccessfully()</script>";

			//echo "<script>setTimeout(window.location='upload.php')</script>";
	}
	else if($row > 0){ // AQUI É UM CLIENTE

			$idpessoa = mysqli_query($conexao, "SELECT idcliente FROM cliente WHERE email='$email' and senha='$senha'") or die(mysqli_error());


			session_start();
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['senha'] = $_POST['senha'];

			
			$query = sprintf("SELECT * FROM cliente WHERE email='$email' and senha='$senha'");

			$dados = mysqli_query($conexao, $query) or die(mysql_error());

			$linha = mysqli_fetch_assoc($dados);

			$idpessoa = $linha['idcliente'];
			$_SESSION['idpessoa'] = $idpessoa;

			$_SESSION['foto'] = $linha['foto'];
			$_SESSION['nome'] = $linha['nome'];
			$_SESSION['cpf'] = $linha['cpf'];
			$_SESSION['telefone'] = $linha['telefone'];
			$_SESSION['cartao'] = $linha['numerocc'];

			$_SESSION['categoria'] = 0;
			echo "<script>alert('Logado como Cliente')</script>";
			echo "<script>loginsuccessfully()</script>";

			//echo "<script>setTimeout(window.location='upload.php')</script>";
	}
	else{
			echo "<script>alert('Email ou senha invalida')</script>";
			echo "<script>loginfailed()</script>";

			//echo "<script>setTimeout(window.location='index.php')</script>";
	}

?>

</body>
</html>
