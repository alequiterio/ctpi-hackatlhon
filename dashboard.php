
<?php
require_once __DIR__."/consulta.php";

 $user = $_SESSION['login'];

 if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
 {
   unset($_SESSION['login']);
   unset($_SESSION['senha']);
   header('location:index.html');
   }
  
 $logado = $_SESSION['login'];
date_default_timezone_set('America/Sao_Paulo');
$date = date('d-m-Y h');
$xml = file_get_contents("http://servicos.cptec.inpe.br/XML/cidade/4748/todos/tempos/ondas.xml");
$string = $xml;
$xml = simplexml_load_string($string);
$mare = $xml->previsao->altura;
$mare = 1.5; //exemplo do elerta
  
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Painel | SANTOS BRASIL </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
   <link rel="stylesheet" href="dist/css/Admin.css">
  
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style>
      #map {
        height: 100%;
        
      }
      
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>TP</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SANTOS BRASIL</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only"></span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="dist/img/avatar5.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $user;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">

                <p>
                <?php echo $user;?>
                  
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sair</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user;?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Painel</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="index.php"><i class="fa fa-ship"></i> <span>Gestão</span></a></li>
        <li><a href="AgendaNav.php"><i class="fa fa-ship"></i> <span>Agenda de Atracação</span></a></li>
        <li><a href="escala.php"><i class="fa fa-calendar"></i> <span>Escala de Trabalho</span></a></li>
        <li><a href="profile.html"></i> <span><i class="fa fa-twitter" aria-hidden="true"></i> </span>Twitter</a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-book"></i> <span>Treinamentos Obrigatórios</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="treinamentosObrigatorios.php">Meus treinamentos</a></li>
            <li><a href="treinamentosOnline.php">Treinamentos a fazer</a></li>
          </ul>
        </li>
         <li><a href="exames.php"><i class="fa fa-stethoscope"></i> <span>Exames</span></a></li>
      </ul>
      
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Avisos</h1>
  <br/>
      <div class="col-xs-12 ">
        
        <div class="box mobile">
          <div class="box-header">
            <?php if($mare == 1.5) 
                echo '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alerta!</h4>
                Atenção maré alta "'.$mare.'" !
              </div>' ?>
            <h3 class="box-title">Previsão da mare:</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example2" class="table table-bordered table-hover ">
             
              <tr>
                <th>cidade</th>
                <th>data</th>
                <th>Agitação</th>
                <th>altura</th>
                <th>direção</th>
                <th>vento</th>
                <th>direção do vento</th>
              </tr>
              
              <tr>
                <td><?php echo $xml->nome?></td>
                <td><?php echo $xml->previsao->dia ?></td>
                <td><?php echo $xml->previsao->agitacao ?></td>
                <td><?php echo $xml->previsao->altura ?></td>
                <td><?php echo $xml->previsao->direcao ?></td>
                <td><?php echo $xml->previsao->vento ?></td>
                <td><?php echo $xml->previsao->vento_dir ?></td>
              </tr>
            </table>
        
          </div>
          <!-- /.box-body -->
        </div>

          <!-- /.MAPA -->
      <div class="col-md-12">
        <div class="box mobile">
          <div class="box-header">
            <h3 class="box-title">Fique ligado no tráfego em tempo real na região de acesso ao porto!</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="height: 365px;">
                 <div id="map"></div>

          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.MAPA -->
        <!-- /.box -->
      <div class="col-md-12">
        <div class="box mobile">
          <div class="box-header">
            <h3 class="box-title">Avisos importantes</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example" class="table table-bordered table-hover">
             
              <tr>
                <th>Avisos diários</th>
                 <th>data</th>
              </tr>
             
            <?php 
            while ($linha = $resultGrupoLogado->fetch(PDO::FETCH_ASSOC )) {
              
              echo " <tr><td>{$linha['AVISO']}</td> 
                    <td>{$linha['DTAVISO']} </td></tr>";
              }?>
              
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
     
     
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs"></div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 <a href="#">Raptores</a>.</strong> Todos os direitos reservados.
  </footer>

 
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

  
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
     <script>
       
        var map;
             function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 15,
              center: {lat: -23.93056336, lng: -46.35254145}
            });

            var trafficLayer = new google.maps.TrafficLayer();
            trafficLayer.setMap(map);
          }

</script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlbpBhpV4xPTA59neJLJsfp9U2PyZxgjg&callback=initMap"
    async defer>
</script>

</body>
</html>
