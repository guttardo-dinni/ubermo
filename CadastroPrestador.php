
<html>
<head>
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

<form method="post" action="CadastrandoPrestador.php">

	<br><br><br><br><br>
	<center><h1 style="color: white"> Cadastro de Prestador </h1></center>
	<center>
		<br>
		<input class="w3-input w3-border" type="text" placeholder="Nome" required type ="text" <ce name="nome"/><br>
		<input class="w3-input w3-border" type="text" placeholder="Email" required type ="text" <ce name="email"/><br>
		<input class="w3-input w3-border" type="text" placeholder="CPF" required type ="text" <ce name="cpf"/><br>
		<input class="w3-input w3-border" type="text" placeholder="Telefone" required type ="text" <ce name="telefone"/><br>
		<input class="w3-input w3-border" placeholder="Senha" required type="password" name="senha"/><br>
		<input class="w3-button w3-block w3-black" style="width:200px" type="submit" name="CADASTRAR" value="CADASTRAR"/><br>
	</center>

	
</form>

</body>
</html>