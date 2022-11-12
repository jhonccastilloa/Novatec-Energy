<?php
require "conection.php";
session_start();

if (isset($_REQUEST['login'])) {
  $usuario = $_REQUEST['usuario'];
  $password = $_REQUEST['password'];
  $query = "select id,user,password,user_name from users where user='$usuario'";
  $resultado = $conn->query($query);
  $num = $resultado->num_rows;
  if ($num > 0) {
    $row = $resultado->fetch_assoc();
    $pass_bd = $row['password'];
    $pass_c = sha1($password);
    if ($pass_bd == $pass_c) {
      $_SESSION['name'] = $row['user_name'];
      $_SESSION['id'] = $row['id'];
      header("Location: index.php");
      print $_SESSION['name'];
    } else {
      $alert = '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                        Contraseña incorrecta
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
      session_destroy();
    }
  } else {
    echo "<script type='text/javascript'>alert('Este usuario no existe')</script>";
  }
}
?>
<!doctype html>
<html lang="en" class="html">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SISNovatec</title>
	<link rel="shortcut icon" type="image/png" href="../assets/img/favicon.png">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">
</head>
<div class="loginCaja">
  <div class="text-center card bg-white bodyLogin">
    <main class="form-signin w-100 m-auto">
      <form action="login.php" method="POST">
        <img class="mb-4" src="../assets/img/logo.png" alt="Logo de la DREP" width="200">
        <h1 class="h3 mb-3 fw-normal">Login <br>SISNovatec</h1>
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <div class="form-floating">
          <label for="floatingInput">Usuario</label>
          <input type="text" class="form-control" id="floatingInput" placeholder="Usuario" name="usuario">
        </div>
        <div class="form-floating">
          <label for="floatingPassword">Contraseña</label>
          <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
        </div>
        <br>
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Ingresar</button>
      </form>
    </main>
  </div>
</div>

</html>