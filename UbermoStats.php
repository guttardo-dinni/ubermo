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
		$foto = $_SESSION['foto'];
	}

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
	<h1><center>Estatísticas UBERMO</center></h1>

	<?php

	$query = sprintf("SELECT * FROM solicitacao"); 

	$dados = mysqli_query($conexao, $query) or die(mysql_error());

	$linha = mysqli_fetch_assoc($dados);

	$total = mysqli_num_rows($dados);

	$posicao = 0;


		if($total > 0) {
			do { 
				$clientes[$posicao] = $linha['idcliente']; 
				$prestadores[$posicao] = $linha['idprestador'];
				$servicos[$posicao] = $linha['nomeservico'];  
				$posicao = $posicao + 1; 
			}while($linha = mysqli_fetch_assoc($dados));
		}

		$posicao = 0; ?> <center> <?php

		$count=array_count_values($servicos);//Counts the values in the array, returns associatve array
		arsort($count);//Sort it from highest to lowest
		$keys=array_keys($count);//Split the array so we can find the most occuring key
		echo "O servico que mais ocorreu foi $keys[0], seguido de $keys[1]."; ?> <br> <?php

		$count2=array_count_values($clientes);//Counts the values in the array, returns associatve array
		arsort($count2);//Sort it from highest to lowest
		$keys2=array_keys($count2);//Split the array so we can find the most occuring key
		echo "O cliente que mais solicitou foi ID $keys2[0]."; ?> <br> <?php

		$count3=array_count_values($prestadores);//Counts the values in the array, returns associatve array
		arsort($count3);//Sort it from highest to lowest
		$keys3=array_keys($count3);//Split the array so we can find the most occuring key
		echo "O prestador que mais atendeu foi ID $keys3[0]."; ?> <br></center> <?php


		?>

	<br>
	<center><a href="upload.php"> VOLTAR </a>  </center>

	</body>
	</html>

	<br><center> <?php if($categoria == 1) { echo "Logado com Prestador ID$idpessoa - $email";} else if($categoria == 0) echo "Logado com Cliente ID$idpessoa - $email";?> <a href="logout.php"> [SAIR]</a>  </center>