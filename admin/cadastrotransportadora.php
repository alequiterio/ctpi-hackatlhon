<?php
if (!empty($_POST)) {
  if (
    !empty($_POST['empresa']) &&
    !empty($_POST['telefone']) &&
    !empty($_POST['email']) &&
    !empty($_POST['senha'])
  ) {

    $pdo = new PDO('mysql:host=localhost;dbname=bd_stp;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $empresa = $_POST['empresa'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $s = $pdo->prepare('SELECT email FROM usuarios WHERE email = ? ');
    $s->execute(array($email));

    if ($s->rowCount() > 0) {
      ?>
      <script>
        alert("E-mail já cadastrado!");
      </script>
    <?php
    } else {
      $cadastrousuario = $pdo->exec(
        "INSERT INTO  usuarios(`id_usuario`, `email`, `senha`, `tipo_user`, `empresa`, `telefone`)
       VALUES ('', '$email','$senha','1','$empresa','$telefone')"
      );
      ?>
      <script>
        alert("Usuário Cadastrado com Sucesso! \n Volte e faça login");
      </script>
    <?php
    }
  }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
  <script>
    alert("Preencha todos os campos");
  </script>
<?php
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
            <div class="tituloindex text-center"><b>Cadastro de Transportadora</b></div>
            <form action="cadastrotransportadora.php" method="POST" class="form-signin">

              <div class="form-label-group">
                <input type="text" id="inputTransportadora" name="empresa" class="form-control" placeholder="Transportadora" autofocus>
                <label for="inputTransportadora">Nome da Transportadora</label>
              </div>

              <div class="form-label-group">
                <input type="tel" id="inputTelefone" name="telefone" class="form-control" placeholder="Telefone" autofocus>
                <label for="inputTelefone">Telefone</label>
              </div>

              <div class="form-label-group">
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="E-mail">
                <label for="inputEmail">E-mail</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="inputPassword" name="senha" class="form-control" placeholder="Password">
                <label for="inputPassword">Senha</label>
              </div>


              <button class="btn btn-lg btn-primary btn-block text-uppercase" type=" submit"> Cadastrar </a></button>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="reset">Limpar</button>



              <hr class="my-4">
              <div class="text-center">
                <a class="btn btn-lg btn-secondary btn-block text-uppercase" href="index.php">Voltar</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>



</body>

</html>