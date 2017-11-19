
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
		body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}
		body {
		    background-image: url("fundo.jpg");
		    background-color: #cccccc;
		}
	</style>

	<body class="w3-content" style="max-width:500px">
		<form method="post" action="autentica.php">
			<br><br><center><h1 class="w3-animate-top" style="color:white"> UBERMO </h1></center><br><br><br>
			<h5 style="color:white" class="w3-animate-left"> Login:</h5><br>
			<center class="w3-animate-left">
				<input class="w3-input w3-border" placeholder="Email" required type ="text" <ce name="email"/><br>
				<p><input class="w3-input w3-border" placeholder="Senha" required type="password" name="senha"/></p><br>
				<p> <input class="w3-button w3-block w3-black" style="width:200px" type="submit" name="ENTRAR" value="ENTRAR"/></p><br>
				<h6 style="color:white">Não possui login?</h6>
				<a style="color:aqua" href="cadastro1.php">Clique aqui para se cadastrar</a>
			</center>
		</form>
	</body>
</html>