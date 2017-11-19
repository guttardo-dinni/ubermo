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
	$host = "localhost";
	$user = "root";
	$senha = "";
	$banco = "trabalho";

	$conexao = mysqli_connect($host, $user, $senha, $banco) or die(mysqli_error());

	mysqli_select_db($conexao, $banco);

?>
<html>
<head>
	<title>Servico Concluido UBERMO</title>
</head>
<body background = "plano.jpg">

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
			<center> Deixe um comentário sobre o servico: <textarea name="comentario"></textarea> </center><br>	
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