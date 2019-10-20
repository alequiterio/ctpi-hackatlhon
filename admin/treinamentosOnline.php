<?php
 require('consulta.php');

 $user = $_SESSION['login'];
 if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
 {
   unset($_SESSION['login']);
   unset($_SESSION['senha']);
   header('location:index.html');
   }
  
 $logado = $_SESSION['login']; 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Painel | SANTOS BRASIL</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">

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
      <span class="logo-lg"><b>SANTOS BRASIL </b></span>
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
                  <small><?php echo $user;?></small>
                </p>
              </li>
              
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
        <li><a href="consultasiscomex.html"><i class="fa fa-ship"></i> <span>Consulta</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-book"></i> <span>Treinamentos Obrigatórios</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="treinamentosObrigatorios.php">Meus treinamentos</a></li>
            <li><a href="#">Treinamentos a fazer</a></li>
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
      <h1>Treinamentos a fazer</h1></br>
      <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Status</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Procurar">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Nome</th>
                  <th>Data do Treinamento</th>
                  <th>Vencimento</th>
                  <th>Reciclagem</th>
                  <th>Status</th>
                  <th>Remarcar<th>
                </tr>
                <?php 

            while ($lineDados1 = $resultreinamentoAberto ->fetch(PDO::FETCH_ASSOC)) {
               
                if($lineDados1['STATUS_TREINAMENTO'] == 'PENDENTE'){
                   $lineDados1['STATUS_TREINAMENTO'] = '<span class="label label-warning">Pendente</span>';
                }
              echo " <tr><td>{$lineDados1['NOME_TRMT']}</td> 
                    <td>{$lineDados1['DATA_TREINAMENTO']} </td>
                    <td>{$lineDados1['DATA_VENCIMENTO']} </td>
                    <td>{$lineDados1['RECICLAGEM']}</td>
                    <td>{$lineDados1['STATUS_TREINAMENTO']}</td>
                    <td><a href='#'><span class='label label-info'>Liberado</span></a></td>
                    </tr>";
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
    <div class="pull-right hidden-xs">
    
    </div>
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

<!-- fullCalendar -->
<script src="bower_components/moment/moment.js"></script>
<script src="bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="bower_components/fullcalendar/dist/locale-all.js"></script>
<!-- Page specific script -->
<script>
  
    
</script>
</body>
</html>