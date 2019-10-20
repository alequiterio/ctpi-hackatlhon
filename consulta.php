<?php

session_start();
$login = $_SESSION['login'];
//data confg dos navios
date_default_timezone_set('America/Sao_Paulo');
$dateMais = date('Y/m/d 00:00:00' , strtotime( ' + 1 days'));
$dateMenos = date('Y/m/d 00:00:00' , strtotime( ' - 1 days'));
//conexao
$conn = new PDO('mysql:host=localhost;dbname=bd_stp', "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//aviso do grupo
$grupoLogado = "SELECT AVISO,DTAVISO FROM AVISOS WHERE GRUPOAVISO = (SELECT GRUPO FROM tb_funcionario WHERE USUARIO = '$login')  ";
$resultGrupoLogado = $conn->query( $grupoLogado );


//escala de navios
$sql1Navio = "SELECT PREVISAO_ATRACACAO,NAVI_NOME,BERCO_ATRACACAO,INICIO_OPERACAO,FIM_OPERCACAO   FROM navios";
$resultnavio = $conn->query( $sql1Navio );

//noberço
$sql1NavioBerco = "SELECT PREVISAO_ATRACACAO,NAVI_NOME,BERCO_ATRACACAO,INICIO_OPERACAO,FIM_OPERCACAO   FROM navios WHERE INICIO_OPERACAO > '$dateMenos' AND INICIO_OPERACAO < '$dateMais'";
$resultnavioBerco = $conn->query( $sql1NavioBerco );

//rg
$sqlRG = "SELECT RG FROM tb_funcionario WHERE USUARIO = '$login'";
$resultRG = $conn->query( $sqlRG );	
$dadosRg = $resultRG->fetch(PDO::FETCH_ASSOC );
$rg = $dadosRg['RG'];
//Exame
$sql1Exame = "SELECT NOME_EXAME,DATA_EXAME,DATA_RECICLA,TIPO_EXAME,status_exame FROM historicoexame where RG_FUNC = '$rg' ";
$resultExame = $conn->query( $sql1Exame );

//Treinamento
$sqlTreinamento = "SELECT NOME_TRMT,DATA_TREINAMENTO,DATA_VENCIMENTO,RECICLAGEM,STATUS_TREINAMENTO FROM HISTORICO_TREINAMENTO where RG_FUNC = '$rg' ";
$resultreinamento = $conn->query( $sqlTreinamento );

$sqlTreinamentoAberto = "SELECT NOME_TRMT,DATA_TREINAMENTO,DATA_VENCIMENTO,RECICLAGEM,STATUS_TREINAMENTO FROM HISTORICO_TREINAMENTO where RG_FUNC = '$rg' AND STATUS_TREINAMENTO = 'PENDENTE' ";
$resultreinamentoAberto = $conn->query( $sqlTreinamentoAberto );
?>

  
