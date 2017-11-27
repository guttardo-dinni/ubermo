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

	if(!isset($_POST['prestadorname']))
		header("Location: upload.php");

	//CONEXAO COM O BD
	include("config.php");

	$conexao = mysqli_connect($host, $user, $senha, $banco) or die(mysqli_error());

	mysqli_select_db($conexao, $banco);

	?>

	<html>
	<head>
	<title>UBERMO</title>
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
	<h1><center>Pesquisa de prestador</center></h1>

	<?php
	
	$nomeprestador = $_POST['prestadorname'];

	$query = sprintf("SELECT * FROM prestador"); 

	$dados = mysqli_query($conexao, $query) or die(mysql_error());

	$linha = mysqli_fetch_assoc($dados);

	$total = mysqli_num_rows($dados);

	if($total > 0) {
		do { if(strtolower($linha['nome']) == strtolower($nomeprestador)) {
	?>	<center><p><b>INFO: Nome: <?=$linha['nome']?> / Email: <?=$linha['email']?> / Tel: <?=$linha['telefone']?> / Pontuação: <?=$linha['pontuacao']?> </b></p></center>
	<?php
		} else { 
	?>	<center><p>INFO: Nome: <?=$linha['nome']?> / Email: <?=$linha['email']?> / Tel: <?=$linha['telefone']?> / Pontuação: <?=$linha['pontuacao']?></p></center>
	<?php

		}
			}while($linha = mysqli_fetch_assoc($dados));
		}
	?>

	<br>
	<center><a class="w3-button w3-block w3-black" style="width:90px" href="upload.php"> VOLTAR </a>  </center>
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