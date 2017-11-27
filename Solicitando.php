<?php

	error_reporting(0);
	ini_set(“display_errors”, 0 );

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

	if(!isset($_POST['ServicoName']) || !isset($_POST['idEnd'])){
		echo "<script>alert('Favor marcar todos os campos')</script>";
		echo "<script>setTimeout(window.location='AbrirSolicitacao.php')</script>";
	}

	//CONEXAO COM O BD
	include("config.php");

	$conexao = mysqli_connect($host, $user, $senha, $banco) or die(mysqli_error());

	mysqli_select_db($conexao, $banco);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Abrindo Solicitacao UBERMO</title>
</head>
<body background = "plano.jpg">

<?php

	if($_POST['ServicoName'] == NULL || $_POST['idEnd'] == NULL ){
		echo "<script>alert('Favor marcar todos os campos')</script>";
		echo "<script>setTimeout(window.location='AbrirSolicitacao.php')</script>";
	}

		$nomeservico = $_POST['ServicoName'];
		$endereco = $_POST['idEnd'];

		$querysolicitacao = sprintf("SELECT * FROM servico WHERE nomeservico='$nomeservico'");

		$dadossolicitacao = mysqli_query($conexao, $querysolicitacao) or die(mysql_error());

		$linhasolicitacao = mysqli_fetch_assoc($dadossolicitacao);

		$valor = $linhasolicitacao['valormercado']; //BUSCA NA TABELA O VALOR DEFINIDO PRO SERVICO SOLICITADO

		/////////////////////////////////////

		$notaprocliente = 0; // NÃO HÁ NOTA EM SERVIÇO QUE NÃO FOI FINALIZADO
		$notaproprestador = 0; 
		$comcliente = NULL; // NÃO HÁ COMENTÁRIO EM SERVIÇO QUE NÃO FOI FINALIZADO
		$comprestador = NULL; 
		$efetuado = 2; // SETARÁ A VARIÁVEL EFETUADO PARA "AGUARDANDO PRESTADOR"
		$dataAMD = date("Y-m-d"); //FUNÇÃO QUE PEGA A DATA ATUAL

		$sql = mysqli_query($conexao, "INSERT INTO solicitacao (idcliente,nomeservico,idprestador,endereco,valor,notaprocliente,notaproprestador,comcliente,comprestador,efetuado,dataAMD) VALUES ('$idpessoa','$nomeservico','0','$endereco','$valor','$notaprocliente','$notaproprestador','$comcliente','$comprestador','$efetuado','$dataAMD')");
			echo "<script>alert('Solicitacao de $nomeservico realizada com sucesso!')</script>";
			echo "<script>setTimeout(window.location='upload.php')</script>";
	?>

</body>
</html>

	<br><center> <?php if($categoria == 1) { echo "Logado com Prestador ID$idpessoa - $email";} else if($categoria == 0) echo "Logado com Cliente ID$idpessoa - $email";?> <a href="logout.php"> [SAIR]</a>  </center>