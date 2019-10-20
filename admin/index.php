<?php
session_start();
 
if(!empty($_POST)){
  
  $pdo = new PDO(
  'mysql:host=localhost;dbname=bd_stp;charset=utf8',
  'root', '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $r = $pdo->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");

  if (!empty($_POST['inputEmail'])) {
  $email = $_POST['inputEmail'];
  } 


  if (!empty($_POST['inputPassword'])) {
  $senha = $_POST['inputPassword'];
  }

  $r->execute(array($email, $senha));
  $linhas = $r->fetchALL(PDO::FETCH_ASSOC);

  foreach($linhas as $linha){
    $email = $linha['email'];
    $empresa = $linha['empresa'];

  }

  if($r->rowCount()>0){
    if($linha['tipo_user'] == '2'){
      $_SESSION['2'] = $tipo_user;
      session_start();
      $_SESSION['empresa'] = $linha['empresa'];
      header('location: operador.php');
    }

    if($linha['tipo_user'] == '1'){
      $_SESSION['1'] = $tipo_user;
      session_start();
      $_SESSION['empresa'] = $linha['empresa'];
      header('location: transportadoras.php');
    }
  }
  else
  { ?><script> alert('Usuário ou Senha Incorretos!')</script>;
  <?php
  }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <link rel="shortcut icon" href="imagens/container.ico" type="image/x-icon" />
    <script type="text/javascript" src="css/jquery.slim.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <script type="text/javascript" src="css/bootstrap.bundle.min.js"></script>  
    <link rel="stylesheet" type="text/css" href="css/seaport.css">

    <title>Santos Brasil Connect</title>
      
</head>

<body>
  <div class="logo">
   <img src="imagens/logo/logo3.png" width="350" height="100" alt="logo">
  </div>

  <div class="container">
    <div class="row">
      <div class="col-sm-7 col-md-4 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <div class="tituloindex text-center"><b>Login de Acesso</b></div>
            <!-- validar formulario -->
            <form action="index.php" method="POST" class="form-signin">
              <div class="form-label-group">
                <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="E-mail" required autofocus>
                <label for="inputEmail">E-mail</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Senha</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Login</button>
              
              <div class="text-center">
                  <a class="small" href="recuperarsenha.php">Esqueceu a senha?</a></div>
              <hr class="my-4">
              <div class="text-center">
              <a class="lead" href="cadastrotransportadora.php">Cadastrar Transportadora</a></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>



</body>
</html>