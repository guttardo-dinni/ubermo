
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

	$query = sprintf("SELECT * FROM servico");

	$dados = mysqli_query($conexao, $query) or die(mysql_error());

	$linha = mysqli_fetch_assoc($dados);

	$total = mysqli_num_rows($dados);

	$queryend = sprintf("SELECT * FROM endereco WHERE idcliente = '$idpessoa'"); // TODAS OS ENDEREÇOS DO CLIENTE
	$dadosend = mysqli_query($conexao, $queryend) or die(mysql_error());
	$linhaend = mysqli_fetch_assoc($dadosend);
	$totalend = mysqli_num_rows($dadosend); //Número de endereços que a pessoa tem

?>


<html>
<head>
	<title>Nova Solicitacao UBERMO</title>
</head>
<body background = "plano.jpg">

<form method="post" action="Solicitando.php">

	<br><br><br>

	<?php


		if($total > 0 && $totalend > 0) { //O USUÁRIO DEVE POSSUIR ENDEREÇO REGISTRADO PRA SOLICITAR SERVIÇO

				?><center><h2>Selecione o servico a ser solicitado: </h2></center><?php

				do {
					if($linha['status'] == 1){   
		?>		
					<center><p>  <input type="radio" name="ServicoName" value="<?php echo $linha['nomeservico']?>"/> <?=$linha['nomeservico']?> / R$<?=$linha['valormercado']?> diária / <?=$linha['descricao']?> </p></center>
		<?php
				}					

				}while($linha = mysqli_fetch_assoc($dados));
			?>
				<center><a href="Sugestao.php"> Sugerir um novo servico</a> </center>
				<br>
			<?php
			} ?>
				<center><h2>Selecione o endereço onde o servico será realizado: </h2></center>

		<?php if($totalend > 0) {

				do { 
		?>		
					<center><p>  <input type="radio" name="idEnd" value="<?php echo $linhaend['idendereco']?>"/> <?=$linhaend['nomeEnd']?> ( <?=$linhaend['rua']?>, <?=$linhaend['numero']?>, <?=$linhaend['cidade']?>, <?=$linhaend['cep']?> ) </p></center>
		<?php

			}while($linhaend = mysqli_fetch_assoc($dadosend));
			?>

			<center><a href="registraendereco.php">Clique para cadastrar outro endereco</a>  </center> 
			<?php } 

				else {
						?>		<center> Você  não possui enderecos cadastrados </center> 
								<br>
								<center><a href="registraendereco.php">Clique para cadastrar um endereco</a>  </center> 
						<?php

				}
			?>

			<?php if($total > 0 && $totalend > 0) { ?>

			<br>
			<center> <input type="submit" name="SolicitarServico" value="Abrir Solicitacao"/> </center>
			<br>

			<?php } ?>


</form>

</body>
</html>

	<br><center> <?php if($categoria == 1) { echo "Logado com Prestador ID$idpessoa - $email";} else if($categoria == 0) echo "Logado com Cliente ID$idpessoa - $email";?> <a href="logout.php"> [SAIR]</a>  </center>