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
	<title>UBERMO - Novo Endereço</title>
</head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	.w3-sidebar a {font-family: "Roboto", sans-serif}
	body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif; color: white;}
	body {
		background-image: url("blue-slate.jpg");
	    background-color: #cccccc;
	}
</style>

<body>

<form method="post" action="CadastrandoEndereco.php">

	<br><br>
	<center><h2> Novo Endereço</h2></center>
	<br>
	<center>
		<input class="w3-input w3-border" style="margin: 10px; width:300px" placeholder="Identificação (Exemplo: Minha Casa" required type ="text" name="nomeEnd"/>
		<input class="w3-input w3-border" style="margin: 10px; width:300px" placeholder="Rua" required type ="text" name="rua"/>
		<input class="w3-input w3-border" style="margin: 10px; width:300px" placeholder="Nº" required type ="text" name="numero"/>
		<input class="w3-input w3-border" style="margin: 10px; width:300px" placeholder="Complemento" required type ="text" name="complemento"/>
		<input class="w3-input w3-border" style="margin: 10px; width:300px" placeholder="Bairro" required type ="text" name="bairro"/>
		<input class="w3-input w3-border" style="margin: 10px; width:300px" placeholder="Cidade" required type ="text" name="cidade"/>
		<input class="w3-input w3-border" style="margin: 10px; width:300px" placeholder="CEP" required type ="text" name="cep"/>
		<p> <input class="w3-button w3-block w3-black" style="width:200px" type="submit" name="Cadastrar" value="CADASTRAR"/></p>
	</center>

</form>
<br>
	<center><?php 
		if($categoria == 1)
			echo "Prestador - $email";
		else
			echo "Cliente - $email";
		?>
		<br><br>
		<a  class="w3-button w3-block w3-red" style="width:90px" href="logout.php">SAIR</a>
	</center>
</body>
</html>
