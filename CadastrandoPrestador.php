<?php

	if(!isset($_POST['nome']) || !isset($_POST['email']) || !isset($_POST['senha']) || !isset($_POST['cpf']) || !isset($_POST['telefone']) || !isset($_FILES['arquivo']) )
		header("Location: index.php");

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
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	.w3-sidebar a {font-family: "Roboto", sans-serif}
	body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}
	body {
	    background-image: url("fundo.jpg");
	    background-color: #cccccc;
	}
</style>

<body class="w3-content" style="max-width:500px">

<?php



	$nome= $_POST['nome'];
	$email= $_POST['email'];
	$senha = $_POST['senha'];
	$cpf = $_POST['cpf'];
	$telefone = $_POST['telefone'];

	$pontuacao = 0;

	if(isset($_FILES['arquivo'])){
		$extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
		$foto = md5(time()). $extensao; // novo nome do foto
	}
	
	if( $nome == NULL || $email == NULL || $senha == NULL || $telefone == NULL || $cpf == NULL ){
		echo "<script>alert('Favor preencher todos os campos')</script>";
		echo "<script>setTimeout(window.location='CadastroPrestador.php')</script>";
	}
	else if( preg_match('/\d+/', $nome)>0 ){
	   echo "<script>alert('Nome inválido')</script>";
	   echo "<script>setTimeout(window.location='CadastroPrestador.php')</script>";
	}
	else if( strstr($email, '@') == NULL){
		echo "<script>alert('E-mail inválido')</script>";
		echo "<script>setTimeout(window.location='CadastroPrestador.php')</script>";
	}
	else if( strlen($cpf) != 11){
		echo "<script>alert('CPF inválido')</script>";
		echo "<script>setTimeout(window.location='CadastroPrestador.php')</script>";
	}
	else{
		//Abaixo colocando a imagem no na pasta
		$diretorio = "upload/";
		move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$foto);

		$sql = mysqli_query($conexao, "INSERT INTO prestador (nome,email,cpf,telefone,pontuacao,senha,foto) VALUES ('$nome','$email','$cpf','$telefone','$pontuacao','$senha','$foto')");
		
		echo "<script>alert('Prestador cadastrado com sucesso!')</script>";
		echo "<script>setTimeout(window.location='index.php')</script>";

		session_start();
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['senha'] = $_POST['senha'];
		$_SESSION['nome'] = $_POST['nome'];
		$_SESSION['cpf'] = $_POST['cpf'];
		$_SESSION['telefone'] = $_POST['telefone'];

		$_SESSION['pontuacao'] = $_POST['pontuacao'];
		//$_SESSION['numerocc'] = $_POST['numerocc'];
}


?>

</body>
</html>