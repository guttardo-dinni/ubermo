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

	if(!isset($_POST['nomeservico']) || !isset($_POST['valor']) || !isset($_POST['dataAMD']) || !isset($_POST['idsolicitacao']) )
		header("Location: upload.php");

	//CONEXAO COM O BD
	$host = "localhost";
	$user = "root";
	$senha = "";
	$banco = "trabalho";

	$conexao = mysqli_connect($host, $user, $senha, $banco) or die(mysqli_error());

	mysqli_select_db($conexao, $banco);


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Atendendo Solicitacao</title>
</head>
<body background = "plano.jpg">

<?php



	$nomeservico= $_POST['nomeservico'];
	$valor= $_POST['valor'];
	$dataAMD = $_POST['dataAMD'];
	$idsolicitacao = $_POST['idsolicitacao'];
	?>

	<center><?php echo "$nomeservico / $valor / $dataAMD / ATENDENDO AGORA! "?></center>

<?php


		$sql = mysqli_query($conexao, "UPDATE solicitacao SET idprestador='$idpessoa', efetuado ='0' WHERE idsolicitacao = '$idsolicitacao'");
		echo "<script>alert('Solicitacao atendida!')</script>";
		echo "<script>setTimeout(window.location='upload.php')</script>";

?>

</body>
</html>

	<br><center> <?php if($categoria == 1) { echo "Logado com Prestador ID$idpessoa - $email";} else if($categoria == 0) echo "Logado com Cliente ID$idpessoa - $email";?> <a href="logout.php"> [SAIR]</a>  </center>