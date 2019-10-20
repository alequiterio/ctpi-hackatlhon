<?php
session_start();
$login = $_SESSION['login'];

header('Content-type: application/json');

//conexao
$conn = new PDO('mysql:host=localhost;dbname=bd_stp', "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//grupo
$sqlGrupo = "SELECT GRUPO FROM tb_funcionario WHERE USUARIO = '$login'";
$resultGrupo = $conn->query( $sqlGrupo );	
$dadosGrupo = $resultGrupo->fetch(PDO::FETCH_ASSOC );
$Grupo = $dadosGrupo['GRUPO'];
//acao

$action = (isset($_GET['action']))?$_GET['action']:'ler';
switch ($action) {
	case 'modificar':
			$sqlUpdate = $conn->prepare("UPDATE ESCALA SET 
				title=:title,
				color=:color,
				textColor=:textColor,
				start=:start,
				end=:end 
				WHERE GRUPO = '$Grupo' AND ID=:ID");
			$res = $sqlUpdate->execute(array(
				"ID"=>$_POST['id'],
				"title"=>$_POST['title'],
				"color"=>$_POST['color'],
				"textColor"=>$_POST['textColor'],
				"start"=>$_POST['start'],
				"end"=>$_POST['end']
			));
			echo json_encode($res);

		break;
	
	default:
		
	$sql = $conn->prepare("SELECT id,title,description,color,textColor,start,`end` FROM ESCALA WHERE GRUPO = '$Grupo'");
	$sql->execute();
	$result = $sql->fetchALL(PDO::FETCH_ASSOC);
	echo json_encode($result);
		break;
}

?>