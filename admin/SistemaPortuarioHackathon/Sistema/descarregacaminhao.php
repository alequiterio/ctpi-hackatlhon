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
//php pra usar a placa do caminhao
$preparar = $pdo->query('SELECT Min(id_caminhao), placa from caminhao');

foreach ($preparar as $linhas) {
	$_xxx['id_caminhao'] = $linhas[0];
	$placa_caminhao['placa'] = $linhas[1];
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
			<li><a class="active" href="#"><i class='fas fa-truck fa-fw' style='font-size:16px'></i> Caminhão</a>
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
	<!--Formulario Cadastro Container -->
	<div class="formcadcontainer">
		<form action="descarregacaminhao.php" method="POST">
			<legend>Descarregar Container</legend>

			Matrícula Container:<br>
			<input type="text" name="matricula" class="form-control" placeholder="Ex. XXX1234567" required autofocus><br>

			Local do Armazenamento<br>
			<input type="text" name="localizacao" class="form-control" placeholder="Ex. A11" required autofocus><br>

			Destino - <i>(Placa ou Matrícula)</i><br>
			<input type="text" name="destino" class="form-control" placeholder="Destino" required autofocus><br>

			<input type="submit" value="Descarregar">
			<input type="reset" value="Limpar">
		</form>
		<!-- PHP cadastro container-->
		<?php
		if (!empty($_POST)) {

			if (!empty($_POST['matricula']) && !empty($_POST['localizacao']) && !empty($_POST['destino'])) {

				//$date = date('Y-m-d H:i:s');
				$matricula_container = $_POST['matricula'];
				$localizacao = $_POST['localizacao'];
				$origem = $placa_caminhao['placa'] = $linhas[1];
				$destino = $_POST['destino'];
				$dth_entrada = date('Y-m-d H:i:s');
				$dth_saida = null;
				$status_container = 'Armazenado';


				$s = $pdo->prepare("select matricula_container from container where matricula_container = ? ");
				$s->execute(array($matricula_container));

				if ($s->rowCount() > 0) {
					?>
					<script>
						alert("Matricula já cadastrada!");
					</script>
				<?php
				} else {
					$s = $pdo->prepare("INSERT INTO container(`id_container`,`matricula_container`, `localizacao`, `origem`, `destino`, `dth_entrada`, `dth_saida`, `status_container`)
	 VALUES ('','$matricula_container' ,'$localizacao','$origem', '$destino','$dth_entrada','$dth_saida','$status_container')");

					$s->execute(array(
						':id_container', ':matricula_container' => $matricula_container, ':localizacao' => $localizacao, ':origem' => $origem,
						':destino' => $destino, ':dth_entrada' => $dth_entrada, ':dth_saida' => $dth_saida, ':status_container' => $status_container
					));

					if ($s->rowCount() > 0) {
						?>
						<script>
							alert("Container Descarregado com sucesso!");
						</script>
					<?php
					}
				}
			} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				?>
				<script>
					alert("preencha todos os campos!");
				</script>
			<?php
			}
		}

		?>
		<!--Dados Caminhão Fila -->
		<div class="dadoscaminhaofila">

			<?php
			$primeiro = $pdo->query('SELECT Min(id_caminhao), placa, motorista, empresa from caminhao');
			foreach ($primeiro as $linhas) {
				$id_caminhao['id_Caminhao'] = $linhas[0];
				$placa['placa'] = $linhas[1];
				$motorista['motorista'] = $linhas[2];
				$empresa['empresa'] = $linhas[3];
			}

			?>
			<div class="caminhaofila2">
				<form action="carregacaminhao.php" method="get">
					<legend>Caminhão da Fila</legend>
					Placa:<br>
					<input type="text" name="textfield" readonly class="form-control" value="<?php echo $linhas['1'] ?>" autofocus><br>
					Motorista:<br>
					<input type="text" name="textfield" readonly class="form-control" value="<?php echo $linhas['2'] ?>" autofocus><br>
					Empresa:<br>
					<input type="text" name="textfield" readonly class="form-control" value="<?php echo $linhas['3'] ?>" autofocus><br>
			</div>
		</div>
		<!--/Formulario Cadastro Container -->

	</div>
	<div class="remover">
		<br>
		<h6>Finalizar este caminhão? Volte e finalize: <button a href="cadastrarnavio.php">Voltar</button></h6>
	</div>


</body>

</html>