<?php 	//CARREGA A SESSÃO PRA PRÓXIMA PÁGINA
	session_start();
	if(!isset($_SESSION["email"]) || !isset($_SESSION["senha"]) ){
		header("Location: index.php");
		exit;		
	}

	else{
		$idpessoa = $_SESSION['idpessoa'];
		$email= $_SESSION['email'];
		$categoria= $_SESSION['categoria']; 
	} ?>


<html>
<head>
	<title>UBERMO - Sugestões</title>
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

<body class="w3-content" style="max-width:500px">

<form method="post" action="sugere.php">

	<br><br><br>
	<center><h2> UBERMO</h2></center>
	<br>
	<center><h3> Deixe aqui sua sugestão de serviço</h3></center>
	<br><br>
	<center>
		<input class="w3-input w3-border" placeholder="Um nome para o serviço" required type ="text" name="nomeservico"/><br>
		<input class="w3-input w3-border" placeholder="Qual o valor?" required type ="number" name="valormercado"/><br>
		<textarea class="w3-input w3-border" placeholder="Descreva sobre o serviço" name="descricao"></textarea>
		<br>
		<p> <input class="w3-button w3-block w3-black" style="width:200px" type="submit" name="SUGERIR!" value="SUGERIR!"/></p>
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
