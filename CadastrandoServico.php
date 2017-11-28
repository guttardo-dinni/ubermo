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

	if($categoria == 0)
		header("Location: upload.php");

	if(!isset($_POST['nomeservico']))
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
	<title>Registro de endereço UBERMO</title>
</head>
<body background = "plano.jpg">

<?php

	$servico = $_POST['nomeservico'];

		$sql = mysqli_query($conexao, "UPDATE servico SET status=1 WHERE nomeservico = '$servico'");
		$sql = mysqli_query($conexao, "UPDATE sugerec SET aprovado=1 WHERE nomeservico = '$servico'");
		echo "<script>alert('$servico aceito com sucesso!')</script>";
		echo "<script>setTimeout(window.location='upload.php')</script>";
			
?>

</body>
</html>

<br><center> <?php if($categoria == 1) { echo "Logado com Prestador ID$idpessoa - $email";} else if($categoria == 0) echo "Logado com Cliente ID$idpessoa - $email";?> <a href="logout.php"> [SAIR]</a>  </center>