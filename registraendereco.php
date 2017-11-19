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

	//CONEXAO COM O BD
	$host = "localhost";
	$user = "root";
	$senha = "";
	$banco = "trabalho";

	$conexao = mysqli_connect($host, $user, $senha, $banco) or die(mysqli_error());

	mysqli_select_db($conexao, $banco);

?>

<html>
<head>
	<title>Registro de endereço UBERMO</title>
</head>
<body background = "plano.jpg">

<form method="post" action="CadastrandoEndereco.php">

	<br><br><br><br><br><br><br><br><br>
	<center><h2> Sistema de Cadastro de Endereço </h2></center>
	<center> Identificação (Exemplo: Minha Casa): <input type="text" name="nomeEnd"/> </center>
	<br>
	<center> Rua: <input type ="text" name="rua"/> </center>
	<br>
	<center> Número: <input type ="text" name="numero"/> </center>
	<br>
	<center> Complemento: <input type ="text" name="complemento"/> </center>
	<br>
	<center> Bairro: <input type ="text" name="bairro"/> </center>
	<br>
	<center> Cidade: <input type ="text" name="cidade"/> </center>
	<br>
	<center> CEP: <input type="text" name="cep"/> </center>
	<br>
	<center> <input type="submit" name="Cadastrar" value="Registrar endereço"/> </center>

	
</form>

</body>
</html>

<br><center> <?php if($categoria == 1) { echo "Logado com Prestador ID$idpessoa - $email";} else if($categoria == 0) echo "Logado com Cliente ID$idpessoa - $email";?> <a href="logout.php"> [SAIR]</a>  </center>