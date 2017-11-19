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
	<h1><center>Consulta de solicitações</center></h1>

	<?php

	$query = sprintf("SELECT * FROM sugerec"); 
	$query2 = sprintf("SELECT * FROM sugerep"); 

	$dados = mysqli_query($conexao, $query) or die(mysql_error());
	$dados2 = mysqli_query($conexao, $query2) or die(mysql_error());

	$linha = mysqli_fetch_assoc($dados);
	$linha2 = mysqli_fetch_assoc($dados2);

	$total = mysqli_num_rows($dados);
	$total2 = mysqli_num_rows($dados2);

	?><form method="post" action="upload.php"><?php

	if($total > 0) {
		do { 
	?>	<center><p>O cliente ID <?=$linha['idcliente']?> sugeriu o serviço: "<?=$linha['nomeservico']?>" <input type="submit" name="Aprovar" value="Aprovar serviço"/></p></center></form><?php

			}while($linha = mysqli_fetch_assoc($dados));
	}

	if($total2 > 0) {
		do { 
	?>	<center><p>O prestador ID <?=$linha['idprestador']?> sugeriu o serviço: "<?=$linha['nomeservico']?>" <input type="submit" name="Aprovar" value="Aprovar serviço"/></p></center></form><?php

			}while($linha = mysqli_fetch_assoc($dados));
	}

	?>

	<br>
	<center><a href="upload.php"> VOLTAR </a>  </center>

	</body>
	</html>

	<br><center> <?php if($categoria == 1) { echo "Logado com Prestador ID$idpessoa - $email";} else if($categoria == 0) echo "Logado com Cliente ID$idpessoa - $email";?> <a href="logout.php"> [SAIR]</a>  </center>