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
	
	if($tipoconta == 1){ //CLIENTE
	
		$sql = mysqli_query($conexao, "SELECT * FROM cliente WHERE email='$email' and senha='$senha'") or die(mysqli_error());
		$row = mysqli_num_rows($sql);
		
		if($row < 1){
			echo "<script>alert('Email ou senha invalida')</script>";
			echo "<script>loginfailed()</script>";
			exit;
		}

		session_start();
		
		$query = sprintf("SELECT * FROM cliente WHERE email='$email' and senha='$senha'");
		$dados = mysqli_query($conexao, $query) or die(mysql_error());
		$linha = mysqli_fetch_assoc($dados);

		//salva os dados da pessoa na sessao
		$_SESSION['idpessoa'] = $linha['idcliente'];
		$_SESSION['nome'] = $linha['nome'];
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['cpf'] = $linha['cpf'];
		$_SESSION['foto'] = $linha['foto'];
		$_SESSION['pontuacao'] = $linha['pontuacao'];
		$_SESSION['telefone'] = $linha['telefone'];
		$_SESSION['cartao'] = $linha['numerocc'];
		$_SESSION['senha'] = $_POST['senha'];
		$_SESSION['categoria'] = 0;
		
		echo "<script>alert('Logado como Cliente')</script>";
		echo "<script>loginsuccessfully()</script>";
	}
	
	else if($tipoconta == 2){ //PRESTADOR
	
		$sql = mysqli_query($conexao, "SELECT * FROM prestador WHERE email='$email' and senha='$senha'") or die(mysqli_error());
		$row = mysqli_num_rows($sql);
		
		if($row < 1){
			echo "<script>alert('Email ou senha invalida')</script>";
			echo "<script>loginfailed()</script>";
			exit;
		}

		session_start();
		
		$query = sprintf("SELECT * FROM prestador WHERE email='$email' and senha='$senha'");
		$dados = mysqli_query($conexao, $query) or die(mysql_error());
		$linha = mysqli_fetch_assoc($dados);

		//salva os dados da pessoa na sessao
		$_SESSION['idpessoa'] = $linha['idprestador'];
		$_SESSION['nome'] = $linha['nome'];
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['cpf'] = $linha['cpf'];
		$_SESSION['foto'] = $linha['foto'];
		$_SESSION['pontuacao'] = $linha['pontuacao'];
		$_SESSION['telefone'] = $linha['telefone'];
		$_SESSION['senha'] = $_POST['senha'];
		$_SESSION['categoria'] = 1;
		
		echo "<script>alert('Logado como Prestador')</script>";
		echo "<script>loginsuccessfully()</script>";
	}
	
	else{
		echo "<script>alert('Email ou senha invalida')</script>";
		echo "<script>loginfailed()</script>";
		exit;
			//echo "<script>setTimeout(window.location='index.php')</script>";
	}

?>

</body>
</html>
