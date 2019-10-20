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

	<title>Santos Brasil Connect - Operador</title>
</head>

<body>

	<!--Navbar -->

	<div class="topnav">
		<a href="operador.php"><img src="imagens/logo/logo3.png" width="180" height="50" alt="logo"> </a>
		<li class="right"><a href="logout.php">Sair <i class='fas fa-sign-out-alt fa-fw' style='font-size:16px'></i> </a></li>
		<div class="useremp">
			<a>Usuário: <?php echo $_SESSION['empresa']; ?> </a>
		</div>
	</div>

	<!--/Navbar -->

	<!--Sidebar -->

	<div class="menu">
		<ul class="mainmenu">
			<li><a class="active" href="operador.php"><i class='fas fa-home fa-fw' style='font-size:16px'></i> Home </a></li>
			<li><a href="#"><i class='fas fa-truck fa-fw' style='font-size:16px'></i> Caminhão</a>
				<ul class="submenu">
					<li><a href="carregacaminhao.php"><i class='fas fa-pallet fa-fw' style='font-size:16px'></i> Carregar</a></li>
					<li><a href="descarregacaminhao.php"><i class='fas fa-truck-loading fa-fw' style='font-size:16px'></i> Descarregar</a></li>
				</ul>
			</li>
			<li><a href="#"><i class='fas fa-ship fa-fw' style='font-size:16px'></i> Navio</a>
				<ul class="submenu">
					<li><a href="carreganavio.php"><i class='fas fa-pallet fa-fw' style='font-size:16px'></i> Carregar</a></li>
					<li><a href="descarreganavio.php"><i class='fas fa-truck-loading fa-fw' style='font-size:16px'></i> Descarregar</a></li>
				</ul>
			</li>
			<li><a href="patio.php"><i class='fas fa-cubes fa-fw' style='font-size:18px'></i> Pátio</a></li>
			<li><a href="relatorio.php"><i class="fas fa-file-alt" style='font-size:18px'></i> Relatório</a></li>
			<li><a href="contatooperador.php"><i class='far fa-address-card fa-fw' style='font-size:16px'></i> Contato</a></li>
		</ul>
	</div>

	<!--/Sidebar -->
	<!-- conteudo -->
	<div class="relatoriogeral">
		<?php
		$lista = $pdo->query('SELECT * FROM container Order by dth_entrada desc');

		echo '<table class="table">';
		echo '<thead class="thead-dark"><tr><th>ID</th><th>MATRÍCULA CONTAINER</th><th>LOCAL ARMAZENADO</th><th>ORIGEM</th><th>DESTINO</th>
<th>DATA ENTRADA</th><th>DATA SAIDA</th><th>STATUS</td></tr></thead>';
		foreach ($lista as $linha) {
			echo '<tr><td>' . $linha['id_container'] . '</td><td>' . $linha['matricula_container'] . '</td><td>' . $linha['localizacao'] .
				'</td><td>' . $linha['origem'] . '</td><td>' . $linha['destino'] . '</td><td>' . $linha['dth_entrada'] . '</td>
    <td>' . $linha['dth_saida'] . '</td><td>' . $linha['status_container'] . '</td></tr>';
		}
		echo '</table>';


		?>
	</div>
	<!-- / conteudo-->
</body>

</html>