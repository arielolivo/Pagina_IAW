<?php
ob_start();
?>
<?php
session_start();
if(!isset($_SESSION['logueado']) && $_SESSION['logueado'] == FALSE) {
  header("Location: index.php");
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

<?php include "header.php"; ?>

<div id="wrapper">

  <?php
  if(isset($_POST['codigo'])) {

    require("conexion.php");

    $code = $mysqli->real_escape_string($_POST['code']);

    $consultausuario = "SELECT code FROM users WHERE username = '".$_SESSION['username']."'";
    $resultadousuario = $mysqli->query($consultausuario);
    $row = $resultadousuario->fetch_array();

    if($row['code'] == $code) {

      Header("Refresh: 2; URL=home.php");
      echo "Felicidades ya haz confirmado tu email";

      $sql = $mysqli->query("UPDATE users SET confirmed = '1' WHERE username = '".$_SESSION['username']."'");
    }

    else {

      echo "El codigo no coincide";

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
        <input type="text" placeholder="Codigo de seguridad" class="input" name="code" required />
        <input type="submit" value="Confirmar Email" class="btn" name="codigo" />
      </div>
    </form>
  </div>

</div>

</body>
</html>
<?php
ob_end_flush();
?>
