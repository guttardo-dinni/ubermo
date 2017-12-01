
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
				if( strstr($_SESSION['nome'], ' ', true) != NULL )
					echo strstr($_SESSION['nome'], ' ', true);
				else 
					echo $_SESSION['nome'];


			?>
			<br>
			<img src="upload/<?php echo $foto; ?>" width="70" height="75"/>
			<?php


			?>	
		</p>
		</div>
		<div  style="font-weight:bold">
			<?php if($categoria == 0 ) { ?>
			<a href="AbrirSolicitacao.php" class="w3-bar-item w3-button">Abrir Solicitação</a>
			<a href="relatorio.php" class="w3-bar-item w3-button">Relatório financeiro</a>
			<?php } else if($categoria == 1 ) { ?>
			<a href="TodasSolicitacoes.php" class="w3-bar-item w3-button">Consultar Solicitações</a>
			<?php } ?>
			<?php if($categoria == 1) { ?>
			<a href="AprovarServicos.php" class="w3-bar-item w3-button">Aprovar Serviços</a>
			<a href="relatorio.php" class="w3-bar-item w3-button">Relatório financeiro</a>
			<?php } ?>
			<a href="logout.php" class="w3-bar-item w3-button">Sair</a>
		</div>
	</nav>


<form method="post" action="Solicitando.php">

	<br><br><br>

	<?php


		if($total > 0 && $totalend > 0) { //O USUÁRIO DEVE POSSUIR ENDEREÇO REGISTRADO PRA SOLICITAR SERVIÇO

				?><center><h2>Selecione o servico a ser solicitado: </h2></center><?php

				do {
					if($linha['status'] == 1){   
		?>		
					<center><p>  <input type="radio" name="ServicoName" value="<?php echo $linha['nomeservico']?>"/> <?=$linha['nomeservico']?> / R$<?=$linha['valormercado']?> <?php if($linha['tipo'] == 0) echo 'diária'; else if($linha['tipo'] == 1) echo 'por hora'; else if($linha['tipo'] == 2) echo 'valor fixo';?> 


						/ <?=$linha['descricao']?> </p></center>
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

			<center><a class="w3-button w3-block w3-black" style="width:300px" href="registraendereco.php">CADASTRAR NOVO ENDEREÇO</a>  </center> 
			<?php } 

				else {
						?>		<center> Você  não possui enderecos cadastrados </center> 
								<br>
								<center><a class="w3-button w3-block w3-black" style="width:300px" href="registraendereco.php">CADASTRAR NOVO ENDEREÇO</a>  </center> 
						<?php

				}
			?>

			<?php if($total > 0 && $totalend > 0) { ?>

			<br>
			<center> <input type="submit" name="SolicitarServico" value="Abrir Solicitacao"/> </center>
			<br>

			<?php } ?>


</form>
<br>
	<center><?php 
		if($categoria == 1)
			echo "Prestador - $email";
		else
			echo "Cliente - $email";
		?>
		<br><br>
		<a  class="w3-button w3-block w3-red" style="width:90px" href="logout.php">SAIR</a>
	</center>
</body>
</html>

