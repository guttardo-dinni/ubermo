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
	<h1><center>Relatório Financeiro</center></h1>

	<?php

	if($categoria == 1)
		$query = sprintf("SELECT * FROM solicitacao WHERE idprestador='$idpessoa'"); 
	else if($categoria == 0)
		$query = sprintf("SELECT * FROM solicitacao WHERE idcliente='$idpessoa'"); 

	$dados = mysqli_query($conexao, $query) or die(mysql_error());

	$linha = mysqli_fetch_assoc($dados);

	$total = mysqli_num_rows($dados);

	$financas = 0;


		if($total > 0) {
			do { 
				if($linha['efetuado']== 1){
					$financas = $financas + $linha['valor'];
		?>	<center><p>SOLICITAÇÃO ID: <?=$linha['idsolicitacao']?> / Cliente ID: <?=$linha['idcliente']?> / Servico: <?=$linha['nomeservico']?> / Prestador ID: <?=$linha['idprestador']?> / Endereco ID: <?=$linha['endereco']?> / R$: <?=$linha['valor']?> / Data: <?=$linha['dataAMD']?></p></center>
		<?php
				}
				}while($linha = mysqli_fetch_assoc($dados));
			}
	

	if($categoria == 1){
		?><center><?php echo "Voce faturou um total de R$$financas"; ?></center><?php
	}
	else if($categoria == 0){
		?><center><?php echo "Voce gastou um total de R$$financas"; ?></center><?php
	}
	?>

	<br>
	<center><a href="upload.php"> VOLTAR </a>  </center>

	</body>
	</html>

	<br><center> <?php if($categoria == 1) { echo "Logado com Prestador ID$idpessoa - $email";} else if($categoria == 0) echo "Logado com Cliente ID$idpessoa - $email";?> <a href="logout.php"> [SAIR]</a>  </center>