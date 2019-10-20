<?php
$pdo = new PDO(
	'mysql:host=localhost;dbname=bd_stp;charset=utf8',
	'root',
	''
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

session_start();
if (!isset($_SESSION['empresa'])) {
	header('location: index.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="shortcut icon" href="imagens/container.ico" type="image/x-icon" />
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
	<link rel="stylesheet" href="css/geral.css">

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

	<title> Santos Brasil Connect - Transportadoras</title>
</head>

<body>

	<!--Navbar -->

	<div class="topnav">
		<a href="#"><img src="imagens/logo/logo3.png" width="180" height="50" alt="logo"> </a>
		<li class="right"><a href="logout.php">Sair <i class='fas fa-sign-out-alt fa-fw' style='font-size:16px'></i> </a></li>
		<div class="useremp">
			<a>Usuário: <?php echo $_SESSION['empresa']; ?> </a>
		</div>
	</div>

	<!--/Navbar -->

	<!--Sidebar -->

	<div class="menu">
		<ul class="mainmenu">
			<li><a class="active" href="transportadoras.php"><i class='fas fa-home fa-fw' style='font-size:16px'></i> Home </a></li>
			<li><a href="cadastrarcaminhao.php"><i class='fas fa-truck fa-fw' style='font-size:16px'></i> Cadastrar Caminhão</a></li>
			<li><a href="cadastrarnavio.php"><i class='fas fa-ship fa-fw' style='font-size:16px'></i> Cadastrar Navio</a>
			<li>
			<li><a href="contato.php"><i class='far fa-address-card fa-fw' style='font-size:16px'></i> Contato</a></li>
		</ul>
	</div>

	<!--/Sidebar -->
	<!-- Conteudo -->
	<div class="vindo">
	<h5> BEM VINDO <h5>
	<h5> Utilize o menu ao lado</h5>
	</div>
</body>

</html>