<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=bd_stp;charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


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
            <div class="tituloindex text-center"><b>Esqueceu sua senha?</b></div>
            <div class="tituloindex text-center">Informe seu e-mail:</div>
            <div class="subtituloindex text-center"><a>Sua senha será enviada para o e-mail cadastrado</a></div><br>
            <form class="form-signin">
              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="E-mail" autofocus>
                <label for="inputEmail">E-mail</label>
              </div>


              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Enviar</button>
              <a class="btn btn-lg btn-secondary btn-block text-uppercase" href="index.php">Voltar</a>
              <br>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>