<?php
ob_start();
?>
<?php
session_start();
if(isset($_SESSION['logueado']) && $_SESSION['logueado'] == TRUE) {
  header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Photogram</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
 
<body>

<div id="wrapper">

  <?php
  if(isset($_POST['registro'])) {

    require("conexion.php");

    $email = $mysqli->real_escape_string($_POST['mail']);
    $nombre = $mysqli->real_escape_string($_POST['nombre']);
    $usuario = $mysqli->real_escape_string($_POST['usuario']);
    $password = md5($_POST['password']);
    $ip = $_SERVER['REMOTE_ADDR'];

    $consultausuario = "SELECT username FROM users WHERE username = '$usuario'";
    $consultaemail = "SELECT email FROM users WHERE email = '$email'";

    if($resultadousuario = $mysqli->query($consultausuario));
    $numerousuario = $resultadousuario->num_rows;

    if($resultadoemail = $mysqli->query($consultaemail));
    $numeroemail = $resultadoemail->num_rows;

    if($numeroemail>0) {
      echo "Este correo ya esta registrado, intenta con otro";
    }

    elseif($numerousuario>0) {
      echo "Este usuario ya existe";
    }

    else {

      $aleatorio = uniqid();

      $query = "INSERT INTO users (email,name,username,password,signup_date,last_ip,code) VALUES ('$email','$nombre','$usuario','$password',now(),'$ip','$aleatorio')";

      if($registro = $mysqli->query($query)) {

        Header("Refresh: 2; URL=index.php");

        echo "Felicidades $usuario se ha registrado correctamente, te hemos enviado un correo de confirmacion.";

    

      else {

        echo "Ha ocurrido un error en el registro, intentelo de nuevo";
        header("Refresh: 2; URL=registro.php");

      }


    }

    $mysqli->close();

  }
  ?>
  
  <div class="main-content">
    <div class="header">
      <img src="images/logo.png" />
    </div>
    <form action="" method="post">
      <div class="l-part">
        <input type="email" placeholder="Correo electrónico" class="input" name="mail" required />
        <div class="overlap-text">
          <input type="text" placeholder="Nombre completo" class="input" name="nombre" required />
        </div>
        <div class="overlap-text">
          <input type="text" placeholder="Usuario" class="input" name="usuario" required />
        </div>
        <div class="overlap-text">
          <input type="password" placeholder="Contraseña" class="input" name="password" required />
        </div>
        <input type="submit" value="Registrarte" class="btn" name="registro" />
      </div>
    </form>
  </div>
  <div class="sub-content">
    <div class="s-part">
      ¿Tienes una cuenta? <a href="index.php">Entrar</a>
    </div>
  </div>

</div>

</body>
</html>
<?php
ob_end_flush();
?>