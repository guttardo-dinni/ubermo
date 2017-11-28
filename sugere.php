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

	if(!isset($_POST['nomeservico']) || !isset($_POST['valormercado']) || !isset($_POST['descricao']) )
		header("Location: upload.php");

	//CONEXAO COM O BD
	include("config.php");

	$conexao = mysqli_connect($host, $user, $senha, $banco) or die(mysqli_error());

	mysqli_select_db($conexao, $banco);


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Sistema de Cadastro UBERMO</title>
</head>
<body background = "plano.jpg">

<?php



	$nomeservico= $_POST['nomeservico'];
	$valormercado= $_POST['valormercado'];
	$descricao = $_POST['descricao'];

	$tipo = 1;
	$status = 0;

	//NÃO DEIXAR O USUARIO SUGERIR UM SERVIÇO REPETIDO

	if( $nomeservico == NULL || $valormercado == NULL || $descricao == NULL){
		echo "<script>alert('Favor preencher todos os campos')</script>";
		echo "<script>setTimeout(window.location='CadastroCliente.php')</script>";
	}
	else{ 

		$sql = mysqli_query($conexao, "INSERT INTO servico (nomeservico,valormercado,tipo,status,descricao) VALUES ('$nomeservico','$valormercado','$tipo','$status','$descricao')");

		if($categoria == 0)
			$sql = mysqli_query($conexao, "INSERT INTO sugerec (idcliente,nomeservico) VALUES ('$idpessoa','$nomeservico')");
		else if ($categoria == 1)
			$sql = mysqli_query($conexao, "INSERT INTO sugerep (idprestador,nomeservico) VALUES ('$idpessoa','$nomeservico')");
		//$sql = mysqli_query($conexao, "INSERT INTO servico (nomeservico, valormercado, tipo, status, descricao) VALUES ('Barman', '175', '1', '1', 'Serve bebida pra galera')")
		echo "<script>alert('Sugestão enviada com sucesso!')</script>";
		echo "<script>setTimeout(window.location='AbrirSolicitacao.php')</script>";
}


?>

</body>
</html>

	<br><center> <?php if($categoria == 1) { echo "Logado com Prestador ID$idpessoa - $email";} else if($categoria == 0) echo "Logado com Cliente ID$idpessoa - $email";?> <a href="logout.php"> [SAIR]</a>  </center>