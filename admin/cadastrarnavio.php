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
$emp = $_SESSION['empresa'];


?>

<!-- Documento HTML -->
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

	<title> Santos Brasil Connect - Cadastro Navio</title>
</head>

<body>

	<!--Navbar -->

	<div class="topnav">
		<a href="transportadoras.php"><img src="imagens/logo/logo3.png" width="180" height="50" alt="logo"> </a>
		<li class="right"><a href="logout.php">Sair <i class='fas fa-sign-out-alt fa-fw' style='font-size:16px'></i> </a></li>
		<div class="useremp">
			<a>Usuário: <?php echo $_SESSION['empresa']; ?> </a>
		</div>
	</div>

	<!--/Navbar -->

	<!--Sidebar -->

	<div class="menu">
		<ul class="mainmenu">
			<li><a href="transportadoras.php"><i class='fas fa-home fa-fw' style='font-size:16px'></i> Home </a></li>
			<li><a href="cadastrarcaminhao.php"><i class='fas fa-truck fa-fw' style='font-size:16px'></i> Cadastrar Caminhão</a></li>
			<li><a class="active" href="cadastrarnavio.php"><i class='fas fa-ship fa-fw' style='font-size:16px'></i> Cadastrar Navio</a>
			<li>
			<li><a href="contato.php"><i class='far fa-address-card fa-fw' style='font-size:16px'></i> Contato</a></li>
		</ul>
	</div>

	<!--/Sidebar -->
	<!--Formulario Cadastro -->
	<div class="formcadnav">
		<form action="cadastrarnavio.php" method="POST">
			<legend>Cadastro de Navio</legend>

			Matrícula:<br>
			<input type="text" name="matricula" class="form-control" placeholder="Ex: XXX1234567" required autofocus><br>

			Capitão:<br>
			<input type="text" name="capitao" class="form-control" required autofocus><br>

			<input type="submit" value="Cadastrar">
			<input type="reset" value="Limpar">
		</form>
	</div>
	<!--/Formulario Cadastro -->
	<!-- PHP Cadastra navio -->

	<?php

	if (!empty($_POST)) {
		if (!empty($_POST['matricula']) && !empty($_POST['capitao'])) {

			$matricula = $_POST['matricula'];
			$capitao = $_POST['capitao'];
			$empresa = $emp;

			$s = $pdo->prepare('SELECT matricula FROM navio WHERE matricula = ? ');
			$s->execute(array($matricula));

			if ($s->rowCount() > 0) {
				?>
				<script>
					alert("matricula já cadastrada!");
				</script>
			<?php
			} else {
				$s = $pdo->exec(
					"INSERT INTO  navio (`id_navio`, `matricula`, `capitao`, `empresa`)
       VALUES ('', '$matricula','$capitao','$emp')"
				);
				?>
				<script>
					alert("Navio cadastrado com sucesso!");
				</script>
			<?php
			}
		}
	} else if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
		<script>
			alert("Preencha todos os campos");
		</script>
	<?php
	}

	?>
	<!--/ PHP Cadastra navio -->
	<div class="linha">
		<hr>
	</div>
	<!-- Excluir navio -->
	<div class="excluircam">
		<p>Caso deseje excluir um navio, insira a matricula:</p>
		<form action="cadastrarnavio.php" method="GET">
			<input name="matricula" type="text" class="form-control" placeholder="Ex: XXX1234567"><br>
			<button type="submit">Apagar</button><br>
		</form>
	</div>

	<?php

	if (!empty($_GET) && !empty($_GET['matricula'])) {
		$matricula = $_GET['matricula'];
		$empresa = $_SESSION['empresa'];

		$s = $pdo->prepare("DELETE FROM  navio where matricula = ? and empresa = ?");
		$s->execute(array($matricula, $empresa));

		if ($s->rowCount() > 0) {
			?>
			<script>
				alert("Removido com sucesso!");
			</script>
		<?php
		} else {
			?>
			<script>
				alert("Voce não tem permissão para remover esta matricula!");
			</script>
		<?php
		}
	}
	?>

	<!--/ excluir navio-->

	<!--fila navio -->
	<div class="exibefilanavio">
		<legend class="legendleft"> Fila de Navios </legend>
		<?php


		$resultado = $pdo->query('SELECT * FROM navio');

		echo '<table class="table">';
		echo '<thead class="thead-dark"><tr><th>ID NAVIO</th><th>MATRICULA</th><th>CAPITAO</th><th>EMPRESA</th></tr></thead>';
		foreach ($resultado as $linha) {
			echo '<tr><td>' . $linha['id_navio'] . '</td><td>' . $linha['matricula'] . '</td><td>' . $linha['capitao'] .
				'</td><td>' . $linha['empresa'] . '</td></tr>';
		}
		echo '</table>';


		?>
	</div>
	<!--/fila navio -->
</body>

</html>