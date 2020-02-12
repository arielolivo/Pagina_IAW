<!DOCTYPE html>
<html lang="es">
<head>
  <title>Photogram</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>

  <?php
  if(isset($_GET['user']) AND isset($_GET['token'])) {

    require "conexion.php";

    $user = $mysqli->real_escape_string($_GET['user']);
    $token = $mysqli->real_escape_string($_GET['token']);

    $sql = $mysqli->query("SELECT token FROM users WHERE username = '$user'");
    $row = $sql->fetch_array();

    if($row['token'] ==  $token) {
  ?>

<div id="wrapper">

  <?php
  if(isset($_POST['codigo'])) {
    require "conexion.php";

    $contrasena = $mysqli->real_escape_string($_POST['contrasena']);
    $contrasena = md5($contrasena);

    $act = $mysqli->query("UPDATE users SET password = '$contrasena', token = '' WHERE username = '$user'");

    if($act) {
      echo "Su contraseña se ha cambiado, ya puede ingresar";
      Header("Refresh: 0; URL=index.php");
      }
  }
  ?>


  <div class="main-content">
    <div class="header">
      <img src="images/logo.png" />
    </div>
    <form action="" method="post">
      <div class="l-part">
        <input type="text" placeholder="Ingresa tu nueva contraseña" class="input" name="contrasena" required />
        <input type="submit" value="Cambiar contraseña" class="btn" name="codigo" />
      </div>
    </form>
  </div>

</div>

</body>
<?php } } ?>
</html>
