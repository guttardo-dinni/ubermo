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
	<title>UBERMO</title>
</head>
<body background = "plano.jpg">

<form method="post" action="sugere.php">

	<br><br><br><br><br><br><br><br><br>
	<center><h2> UBERMO Login </h2></center>
	<center> Nome do Serviço: <input type ="text" <ce name="nomeservico"/> </center>
	<br>
	<center> Valor: <input type="text" name="valormercado"/> </center>
	<br> 
	<center> Descrição: <textarea name="descricao"></textarea> </center>
	<br> 
	<center> <input type="submit" name="Fazer sugestao" value="Fazer sugestao"/> </center>
	<br>
	
</form>

</body>
</html>

	<br><center> <?php if($categoria == 1) { echo "Logado com Prestador ID$idpessoa - $email";} else if($categoria == 0) echo "Logado com Cliente ID$idpessoa - $email";?> <a href="logout.php"> [SAIR]</a>  </center>