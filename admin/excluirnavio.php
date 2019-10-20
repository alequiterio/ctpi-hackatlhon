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

$primeiro = $pdo->query('SELECT Min(id_navio), matricula, capitao, empresa from navio');
		foreach ($primeiro as $linhas) {
			$id_caminhao['id_navio'] = $linhas[0];
			$placa['matricula'] = $linhas[1];
			$motorista['capitao'] = $linhas[2];
			$empresa['empresa'] = $linhas[3];
		}
		
 			$s = $pdo->prepare("DELETE FROM  navio where matricula = ?");
 			$s->execute(array($linhas[1]));
        header('location: carreganavio.php');
?>