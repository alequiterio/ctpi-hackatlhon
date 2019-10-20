<?php
$pdo = new PDO(
	'mysql:host=localhost;dbname=bd_stp;charset=utf8',
	'root',
	''
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

session_start();
date_default_timezone_set('America/Sao_Paulo');
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
			<li><a href="operador.php"><i class='fas fa-home fa-fw' style='font-size:16px'></i> Home </a></li>
			<li><a href="#"><i class='fas fa-truck fa-fw' style='font-size:16px'></i> Caminhão</a>
				<ul class="submenu">
					<li><a href="carregacaminhao.php"><i class='fas fa-pallet fa-fw' style='font-size:16px'></i> Carregar</a></li>
					<li><a href="descarregacaminhao.php"><i class='fas fa-truck-loading fa-fw' style='font-size:16px'></i> Descarregar</a></li>
				</ul>
			</li>
			<li><a class="active" href="#"><i class='fas fa-ship fa-fw' style='font-size:16px'></i> Navio</a>
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
	<!--Dados Navio Fila -->
	<?php
	$primeiro = $pdo->query('SELECT Min(id_navio), matricula, capitao, empresa from navio');
	foreach ($primeiro as $linhas) {
		$id_navio['id_navio'] = $linhas[0];
		$placa['matricula'] = $linhas[1];
		$motorista['capitao'] = $linhas[2];
		$empresa['empresa'] = $linhas[3];
	}

	?>
	<div class="naviofila">
		<form action="carreganavio.php" method="get">
			<legend>Navio da Fila</legend>
			Matricula:<br>
			<input type="text" name="textfield" readonly class="form-control" value="<?php echo $linhas['1'] ?>" autofocus><br>
			Capitao:<br>
			<input type="text" name="textfield" readonly class="form-control" value="<?php echo $linhas['2'] ?>" autofocus><br>
			Empresa:<br>
			<input type="text" name="textfield" readonly class="form-control" value="<?php echo $linhas['3'] ?>" autofocus><br>
		</form>

		<!--Carrega Containers para Navio-->
		<div class="exibeContainersNavio">
			<form action="carreganavio.php" method="get">
				<legend>Carregamento</legend>

				<p>Verifique na lista se há containers para seu navio digite a matricula e clique em carregar: </p>
				Matrícula:<br>
				<input type="text" name="cod" class="form-control" placeholder="Ex: XXX1234567" required autofocus><br>
				<input type="submit" value="Carregar">
			</form>
			<?php
			if (!empty($_GET)) {
				if (!empty($_GET['cod'])) {
					$matricula_container = $_GET['cod'];
					$dth_saida = date('Y-m-d H:i:s');
					$status_container = 'Carregado';

					$s = $pdo->prepare('UPDATE Container SET dth_saida=?, status_container=? WHERE matricula_container = ?');
					$s->execute(array($dth_saida, $status_container, $matricula_container,));

					if ($s->rowCount() > 0) {
						?>
						<script>
							alert("Container carregado com sucesso!");
						</script>
					<?php
					} else { ?>
						<script>
							alert("Erro !");
						</script>
					<?php
					}
				}
			}
			?>

			<br>
			<br>


			<form action="excluirnavio.php" method="POST>">
				<h6>Clique aqui para finalizar: <button type="submit">Finalizar</button> </h6>
			</form>

			<!--/Dados Navio Fila -->
		</div>
		<div class="linhatotal">
			<hr>
		</div>
		<div class="exibeContainersnaviofila">

			<legend>Containes para carregamento</legend>
			<p>Lista com os containers para este navio</p>
			<?php
			$verifica = $pdo->query('SELECT c.id_container, c.matricula_container, c.localizacao, c.origem, c.destino, c.dth_entrada, c.status_container from container c, navio n Where c.destino = n.matricula and c.status_container = "Armazenado"');

			echo '<table class="table">';
			echo '<thead class="thead-dark"><tr><th>ID</th><th>MATRICULA</th><th>LOCALIZAÇÃO</th><th>ORIGEM</th><th>DESTINO</th><th>DATA ENTRADA</th><th>STATUS</th></tr></thead>';
			foreach ($verifica as $linhas) {
				echo '<tr><td>' . $linhas['id_container'] . '</td><td>' . $linhas['matricula_container'] . '</td><td>' . $linhas['localizacao'] .
					'</td><td>' . $linhas['origem'] . '</td><td>' . $linhas['destino'] . '</td><td>' . $linhas['dth_entrada'] . '</td><td>' . $linhas['status_container'] . '</td></tr>';
			}
			echo '</table>';
			?>

		</div>

		<!--/Dados Navio -->
</body>

</html>