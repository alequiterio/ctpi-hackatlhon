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

$primeiro = $pdo->query('SELECT Min(id_caminhao), placa, motorista, empresa from caminhao');
		foreach ($primeiro as $linhas) {
			$id_caminhao['id_Caminhao'] = $linhas[0];
			$placa['placa'] = $linhas[1];
			$motorista['motorista'] = $linhas[2];
			$empresa['empresa'] = $linhas[3];
		}

 			$s = $pdo->prepare("DELETE FROM  Caminhao where placa = ?");
 			$s->execute(array($linhas[1]));
        header('location: carregacaminhao.php');
?>
