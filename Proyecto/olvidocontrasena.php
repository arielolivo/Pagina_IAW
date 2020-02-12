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
		require "conexion.php";

		$email = $mysqli->real_escape_string($_POST['email']);

		$sql = $mysqli->query("SELECT username,email FROM users WHERE email = '$email'");
		$row = $sql->fetch_array();
		$count = $sql->num_rows;

		if($count == 1) {

			$token = uniqid();

			$act = $mysqli->query("UPDATE users SET token = '$token' WHERE email = '$email'");

			// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
	        $email_to = $email;
	        $email_subject = "Cambio de contrasena";
	        $email_from = "reply.tusitioweb.com";

	        $email_message = "Hola " . $row['username'] . ", haz solicitado cambiar tu contraseña, ingresa al siguiente link\n\n";
	        $email_message .= "https://tuntoriales.000webhostapp.com/nuevacontrasena.php?user=".$row['username']."&token=".$token."\n\n";


	        // Ahora se envía el e-mail usando la función mail() de PHP
	        $headers = 'From: '.$email_from."\r\n".
	        'Reply-To: '.$email_from."\r\n" .
	        'X-Mailer: PHP/' . phpversion();
	        @mail($email_to, $email_subject, $email_message, $headers);

	        echo "Te hemos enviado un email para cambiar tu contraseña";

		} else {

			echo "Este correo electrónico no esta registrado en nuestra base de datos";

		}
	}
	?>


  <div class="main-content">
    <div class="header">
      <img src="images/logo.png" />
    </div>
    <form action="" method="post">
      <div class="l-part">
        <input type="email" placeholder="Email" class="input" name="email" autocomplete="off" required />
        <input type="submit" value="Recuperar mi contraseña" class="btn" name="codigo" />
      </div>
    </form>
  </div>

</div>

</body>
</html>
