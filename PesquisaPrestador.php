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
	$host = "localhost";
	$user = "root";
	$senha = "";
	$banco = "trabalho";

	$conexao = mysqli_connect($host, $user, $senha, $banco) or die(mysqli_error());

	mysqli_select_db($conexao, $banco);

	?>

	<html>
	<head>
	<title>UBERMO</title>
</head>
<body background = "plano.jpg">
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
	<center><a href="upload.php"> VOLTAR </a>  </center>

	</body>
	</html>

	<br><center> <?php if($categoria == 1) { echo "Logado com Prestador ID$idpessoa - $email";} else if($categoria == 0) echo "Logado com Cliente ID$idpessoa - $email";?> <a href="logout.php"> [SAIR]</a>  </center>