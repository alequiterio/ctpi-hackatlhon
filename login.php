<?php 
include 'consulta.php';

session_start();

$login = $_POST['login'];
$senha = $_POST['senha'];
$tipo = $_POST['tipo'];

if($tipo === "0"){
    header('location:index.html');
}else if($tipo === "1"){

$sql = "SELECT  * FROM `tb_funcionario` 
WHERE `USUARIO` = '$login' AND `PASSWORD`= '$senha' AND COD_FUNC = 1";
$result = $conn->query( $sql );
$result = $conn->prepare("SELECT FOUND_ROWS()"); 
$result->execute();
$row_count =$result->fetchColumn();


if($row_count > 0 )
{
$_SESSION['login'] = $login;
$_SESSION['senha'] = $senha;
header('location:dashboard.php');
	
}
else{
  unset ($_SESSION['login']);
  unset ($_SESSION['senha']);
  session_destroy();
  header('location:index.html');
   
  }
}else if($tipo === "2"){
$sql = "SELECT * FROM `tb_funcionario` 
WHERE `USUARIO` = '$login' AND `PASSWORD`= '$senha' AND COD_FUNC = 2";
$result = $conn->query( $sql );
$result = $conn->prepare("SELECT FOUND_ROWS()"); 
$result->execute();
$row_count =$result->fetchColumn();


if($row_count > 0 )
{
$_SESSION['login'] = $login;
$_SESSION['senha'] = $senha;
header('location:admin/admin.php');
	
}
else{
  unset ($_SESSION['login']);
  unset ($_SESSION['senha']);
  session_destroy();
  header('location:index.html');
   
  }
}
?>