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
          <!-- Messages: style can be found in dropdown.less-->
        
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
        <li class="active"><a href="dashboard.php"><i class="fa fa-envelope"></i> <span>Avisos</span></a></li>
        <li><a href="#"><i class="fa fa-ship"></i> <span>Agenda de Atracação</span></a></li>
        <li><a href="escala.php"><i class="fa fa-calendar"></i> <span>Escala de Trabalho</span></a></li>
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
      <li><a href="profile.html"></i> <span><i class="fa fa-twitter" aria-hidden="true"></i> </span>Twitter</a></li>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Navios</h1>
  <br/>
      <div class="col-xs-12 ">
        
        <div class="box mobile">
          <div class="box-header with-border">
            <h3 class="box-title">Confira a Agenda:</h3>
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
             </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class='col-md-12 col-sm-6 col-xs-12'>
              <div class="row">
          <?php 
          
            while ($linha = $resultnavio->fetch(PDO::FETCH_ASSOC )) {

              echo " 
                      <div class='info-box'>
                        <span class='info-box-icon bg-aqua'><i  class='fa fa-ship'></i></span>
                        <div class='info-box-content'>
                          <span class='info-box-number'>{$linha['NAVI_NOME']}</span>
                          <span class='info-box-number'>Previsão de Atracação: <small>{$linha['PREVISAO_ATRACACAO']}</small></span>
                           <span class='info-box-number'>Início da Operação: <small>{$linha['INICIO_OPERACAO']}</small></span>
                            <span class='info-box-number'>Fim da Operação: <small>{$linha['FIM_OPERCACAO']}</small></span>
                            <span class='info-box-number'>Berço de Atracação: <small>{$linha['BERCO_ATRACACAO']}</small></span>
                            <hr>
                        </div>
                       
                      ";
              }?>
            </div>
          </div>
        
        </div><!-- acaba -->

          </div>
          <!-- /.box-body -->
        </div>

      </div> <!-- /.box -->



    </section>

    <!-- Main content -->
    <section class="content container-fluid">

    <div class="col-xs-12 ">
        
        <div class="box mobile">
          <div class="box-header with-border">
            <h3 class="box-title">Confira a Agenda de hoje:</h3>
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
             </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class='col-md-12 col-sm-6 col-xs-12'>
              <div class="row">
          <?php 
            while ($linha = $resultnavioBerco->fetch(PDO::FETCH_ASSOC )) {

              echo " 
                      <div class='info-box'>
                        <span class='info-box-icon bg-aqua'><i  class='fa fa-ship'></i></span>
                        <div class='info-box-content'>
                          <span class='info-box-number'>{$linha['NAVI_NOME']}</span>
                          <span class='info-box-number'>Previsão de Atracação: <small>{$linha['PREVISAO_ATRACACAO']}</small></span>
                           <span class='info-box-number' style='color:#f00'>Início da Operação: <small>{$linha['INICIO_OPERACAO']}</small></span>
                            <span class='info-box-number'>Fim da Operação: <small>{$linha['FIM_OPERCACAO']}</small></span>
                            <span class='info-box-number'>Berço de Atracação: <small>{$linha['BERCO_ATRACACAO']}</small></span>
                            <hr>
                        </div>
                       
                      ";
              }?>
            </div>
          </div>
        
        </div><!-- acaba -->
        
          </div>
          <!-- /.box-body -->
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
     
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 <a href="#">Raptores</a>.</strong> Todos os direitos reservados.
  </footer>


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
        $(function () {
          $('#example1').DataTable()
          $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
          })
        })

</script>


</body>
</html>