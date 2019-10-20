<?php
session_start();
$msg = $_POST['msg'];
$data = $_POST['data'];
$login = $_SESSION['login'];;

$conn = new PDO('mysql:host=localhost;dbname=db_btp', "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "INSERT INTO avisos( AVISO, DTAVISO, GRUPOAVISO) VALUES ('$msg','$data',(SELECT GRUPO FROM tb_funcionario WHERE USUARIO = '$login')) ";
$resultGrupo = $conn->query( $sql );

header('location:admin.php');

?>

  
