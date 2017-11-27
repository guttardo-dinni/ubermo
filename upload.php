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
	include("config.php");

	$conexao = mysqli_connect($host, $user, $senha, $banco) or die(mysqli_error());

	mysqli_select_db($conexao, $banco);

	if($categoria == 1)
		$query = sprintf("SELECT * FROM solicitacao WHERE efetuado='1' and idprestador = '$idpessoa'"); // TODAS AS SOLICITAÇÕES QUE JÁ FORAM CONCLUIDAS (Logado como prestador)
	else
		$query = sprintf("SELECT * FROM solicitacao WHERE efetuado='1' and idcliente = '$idpessoa'"); // TODAS AS SOLICITAÇÕES QUE JÁ FORAM CONCLUIDAS (Logado como cliente)

	$dados = mysqli_query($conexao, $query) or die(mysql_error());

	$linha = mysqli_fetch_assoc($dados);

	$total = mysqli_num_rows($dados);

	if($categoria == 1)
		$querysolicitacao = sprintf("SELECT * FROM solicitacao WHERE efetuado='2'"); // TODAS AS SOLICITAÇÕES QUE ESTÃO AGUARDANDO UM PRESTADOR PEGAR (Logado como prestador)
	else
		$querysolicitacao = sprintf("SELECT * FROM solicitacao WHERE efetuado='2' and idcliente = '$idpessoa'"); // TODAS AS SOLICITAÇÕES DO CLIENTE QUE ESTÃO AGUARDANDO UM PRESTADOR PEGAR (Logado como cliente)

	$dadossolicitacao = mysqli_query($conexao, $querysolicitacao) or die(mysql_error());

	$linhasolicitacao = mysqli_fetch_assoc($dadossolicitacao);

	$totalsolicitacao = mysqli_num_rows($dadossolicitacao);

	if($categoria == 1)
		$querysolicitacaoatendida = sprintf("SELECT * FROM solicitacao WHERE efetuado='0' and idprestador = '$idpessoa'"); // TODAS OS SERVIÇOS QUE ESTÃO SENDO FEITOS POR ALGUM PRESTADOR (Logado como prestador)
	else 
		$querysolicitacaoatendida = sprintf("SELECT * FROM solicitacao WHERE efetuado='0' and idcliente = '$idpessoa'"); // TODAS OS SERVIÇOS QUE ESTÃO SENDO FEITOS POR ALGUM PRESTADOR (Logado como cliente)
 
	$dadossolicitacaoatendida = mysqli_query($conexao, $querysolicitacaoatendida) or die(mysql_error());

	$linhasolicitacaoatendida = mysqli_fetch_assoc($dadossolicitacaoatendida);

	$totalsolicitacaoatendida = mysqli_num_rows($dadossolicitacaoatendida);

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

	<center>
		<br>
		<form method="post" action="PesquisaPrestador.php">
			<input class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-white w3-black" type="submit" name="pesquisa" value="Pesquisar"/>
			<input class="w3-input w3-right w3-border" style="width:200px" type="text" placeholder="Pesquisar Prestador" name="prestadorname"/>
		</form>
	</center>

	<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
		<div class="w3-container w3-display-container w3-padding-16">
		<i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
		<h3 class="w3-wide" style="color: black"><b>UBERMO</b></h3>
		<h6 class='w3-wide' style="color: black"><b>
			<?php 
				if($categoria == 1) 
					{ echo "Prestador";}
				else if($categoria == 0) 
					echo "Cliente";
			?>	
		</b></h6>
		<p style="font-size: 12px">
			<?php
				echo "$email"
			?>	
		</p>
		</div>
		<div  style="font-weight:bold">
			<?php if($categoria == 0 ) { ?>
			<a href="AbrirSolicitacao.php" class="w3-bar-item w3-button">Abrir Solicitação</a>
			<?php } else if($categoria == 1 ) { ?>
			<a href="TodasSolicitacoes.php" class="w3-bar-item w3-button">Consultar Solicitações</a>
			<?php } ?>
			<?php if($categoria == 1) { ?>
			<a href="AprovarServicos.php" class="w3-bar-item w3-button">Aprovar Serviços</a>
			<?php } ?>
			<a href="logout.php" class="w3-bar-item w3-button">Sair</a>
		</div>
	</nav>

	<center><br><br><br><h2>Seus serviços passados: </h2></center>
	<ul>  
<?php
	// se o número de resultados for maior que zero, mostra os dados
	if($total > 0) {
		// inicia o loop que vai mostrar todos os dados
		do {
?>
			<center><p>Solicitacao ID <?=$linha['idsolicitacao']?> / <?=$linha['dataAMD']?> / <?=$linha['nomeservico']?> / R$<?=$linha['valor']?> </p></center>
<?php
		// finaliza o loop que vai mostrar os dados
		}while($linha = mysqli_fetch_assoc($dados));
	// fim do if 
	}
	else {
		?><center>Você não possui serviços passados </center>
	<?php } ?>

<center><h2>Seus serviços em andamento: </h2></center>	<?php

	if($totalsolicitacaoatendida > 0) {
		// inicia o loop que vai mostrar todos os dados
		do {
?>			<form method="post" action="ServicoConcluido.php">
			<center><p>Solicitacao ID <?=$linhasolicitacaoatendida['idsolicitacao']?> / <?=$linhasolicitacaoatendida['dataAMD']?> / <?=$linhasolicitacaoatendida['nomeservico']?> / R$<?=$linhasolicitacaoatendida['valor']?>
			<input type="hidden" name="idConcluido" value="<?php echo $linhasolicitacaoatendida['idsolicitacao']?>">
			<input type="submit" name="servConcluido" value="Serviço Concluído"/></p></center></form>
<?php
		// finaliza o loop que vai mostrar os dados
		}while($linhasolicitacaoatendida = mysqli_fetch_assoc($dadossolicitacaoatendida));
	// fim do if 
	}
	else {
		?><center>Você não possui serviços em andamento </center>
	<?php } ?>


<center><h2>Solicitações pendentes: </h2></center>	<?php
	
	if($categoria == 1)	{ //AS SOLICITACOES AGUARDANDO SEREM ACEITAS SÓ APARECERÃO PROS PRESTADORES

		if($totalsolicitacao > 0) {
			do {
	?>			<form method="post" action="atendesolicitacao.php">
				<center><p> Solicitacao <?=$linhasolicitacao['idsolicitacao']?> <input type="hidden" name="idsolicitacao" value="<?php echo $linhasolicitacao['idsolicitacao']?>">
				 / <?=$linhasolicitacao['nomeservico']?> <input type="hidden" name="nomeservico" value="<?php echo $linhasolicitacao['nomeservico']?>">
				 / R$<?=$linhasolicitacao['valor']?> <input type="hidden" name="valor" value="<?php echo $linhasolicitacao['valor']?>">
				 / <?=$linhasolicitacao['dataAMD']?> <input type="hidden" name="dataAMD" value="<?php echo $linhasolicitacao['dataAMD']?>">
				  <input type="submit" name="atende" value="Atender solicitação"/></p></center></form>
	<?php

			}while($linhasolicitacao = mysqli_fetch_assoc($dadossolicitacao));

		}
		else { ?> 
			<center>Não há solicitações pendentes </center><br>	<?php
		} 

	}

	else {
		if($totalsolicitacao > 0) {
			do {
	?>	<center><p> Solicitacao ID <?=$linhasolicitacao['idsolicitacao']?> / <?=$linhasolicitacao['nomeservico']?> / R$<?=$linhasolicitacao['valor']?> / <?=$linhasolicitacao['dataAMD']?></p></center>
	<?php

			}while($linhasolicitacao = mysqli_fetch_assoc($dadossolicitacao));

		}
		else {
			?><center>Não há solicitações pendentes </center><br>	<?php
		}
	}

?>

</body>
</html>

<?php
// tira o resultado da busca da memória
mysqli_free_result($dados);
?>