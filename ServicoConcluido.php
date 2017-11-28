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

	if(!isset($_POST['idConcluido']))
		header("Location: upload.php");

	//CONEXAO COM O BD
	include("config.php");

	$conexao = mysqli_connect($host, $user, $senha, $banco) or die(mysqli_error());

	mysqli_select_db($conexao, $banco);

?>
<html>
<head>
	<title>Servico Concluido UBERMO</title>
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

	<br><br><br><br><br><br><br><br><br>
	<center><h2> Avaliação do Servico</h2></center>

	<?php

	$idservico = $_POST['idConcluido'];

	$query = sprintf("SELECT * FROM solicitacao WHERE idsolicitacao='$idservico'"); // TODAS AS SOLICITAÇÕES QUE JÁ FORAM CONCLUIDAS (Logado como cliente)

	$dados = mysqli_query($conexao, $query) or die(mysql_error());

	$linha = mysqli_fetch_assoc($dados);

	?>

<?php 	
	if($categoria == 1){ 
		if ($linha['notaprocliente'] == 0 )	{													?>
			<form method="post" action="ConcluirAvaliacao.php">
			<center> Comentário sobre o serviço <textarea name="comentario"></textarea> </center><br>	
			<center> Nota do Cliente (1 a 5): 	<input type ="number" name="nota"/> </center><br>	
			<input type="hidden" name="idservico" value="<?php echo $idservico?>">
			<center> <input type="submit" name="Cadastrar" value="Concluir Avaliacao"/> </center>
			</form><?php 
		} else { 	echo "<script>alert('Você já fez a avaliação desse serviço, aguarde o cliente')</script>";
					echo "<script>setTimeout(window.location='upload.php')</script>"; }
	}

	 else if($categoria == 0) { 
		if ($linha['notaproprestador'] == 0 )	{													?>
			<form method="post" action="ConcluirAvaliacao.php">
			<center> Deixe um comentário sobre o servico: <textarea name="comentario"></textarea> </center><br>	
			<center> Nota do Prestador (1 a 5):	<input type ="number" name="nota"/> </center><br>	
			<input type="hidden" name="idservico" value="<?php echo $idservico?>">
			<center> <input type="submit" name="Cadastrar" value="Concluir Avaliacao"/> </center>
			</form><?php 
		} else{echo "<script>alert('Você já fez a avaliação desse serviço, aguarde o prestador')</script>";
					echo "<script>setTimeout(window.location='upload.php')</script>";} 
	} ?> 

</body>
</html>



<br><center> <?php if($categoria == 1) { echo "Logado com Prestador ID$idpessoa - $email";} else if($categoria == 0) echo "Logado com Cliente ID$idpessoa - $email";?> <a href="logout.php"> [SAIR]</a>  </center>