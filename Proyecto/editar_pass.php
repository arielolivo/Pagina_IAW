<?php
session_start();
if(!isset($_SESSION['logueado']) && $_SESSION['logueado'] == FALSE) {
  header("Location: index.php");
}

include "functions.php";
?>

<!DOCTYPE html>
<html lang="es">  
  <head>    
    <title>Photogram</title>    
    <meta charset="UTF-8">
    <meta name="title" content="Photogram">
    <meta name="description" content="Photogram">    
    <link href="css/style.css" rel="stylesheet" type="text/css"/>  
    <link href="css/instagram.css" rel="stylesheet" type="text/css"/>   
  </head>  
  <body> 

<?php include "header.php"; ?>

<div class="h-content">

	<div class="e-mid">

		<div class="e-left">
			<a href="editar_perfil.php"><button class="button_edit">Editar perfil</button></a>
			<a href="editar_pass.php"><button class="button_edit_on">Cambiar contraseña</button></a> 
			<a href="editar_privacidad.php"><button class="button_edit">Privacidad y seguridad</button></a>
		</div>

		<form action="" method="post">

			<?php 

				if(isset($_POST['editar'])) {
					require "conexion.php";

					$passActual = $mysqli->real_escape_string($_POST['passActual']);
					$pass1 = $mysqli->real_escape_string($_POST['pass1']);
					$pass2 = $mysqli->real_escape_string($_POST['pass2']);

					$passActual = md5($passActual);
					$pass1 = md5($pass1);
					$pass2 = md5($pass2);

					$sqlA = $mysqli->query("SELECT password FROM users WHERE id = '".$_SESSION['id']."'");
					$rowA = $sqlA->fetch_array();

					if($rowA['password'] == $passActual) {

						if($pass1 == $pass2) {

							$update = $mysqli->query("UPDATE users SET password = '$pass1' WHERE id = '".$_SESSION['id']."'");
							if($update) {echo "se ha actualizado tu contraseña";}

						}
						else {
							echo "Las dos contraseñas no coinciden";
						}

					}
					else {
						echo "Tu contraseña actual no coincide";
					}
				}

			?>

		<div class="e-right">
			<div class="e-contenido">
				<div class="e-title">Contraseña Actual</div>
				<div class="e-input"><input type="password" name="passActual" autocomplete="off">
				</div>
			</div>
			<div class="e-contenido">
				<div class="e-title">Contraseña nueva</div>
				<div class="e-input"><input type="password" name="pass1" autocomplete="off">
					<br> <div style="color:red; font-size: 12px;"><?php if(isset($existe)) {echo $existe;} ?></div></div>
			</div>
			<div class="e-contenido">
				<div class="e-title">Escribe otra vez tu contraseña</div>
				<div class="e-input"><input type="password" name="pass2" autocomplete="off"></div>
			</div>
			<div class="e-contenido">
				<div class="e-title"></div>
				<div class="e-but">
					<input type="submit" value="Cambiar contraseña" name="editar" class="button_blue" style="margin-left: 110px; margin-bottom: 30px; color: white; font-size: 16px; padding:6px 9px;font-weight: 600;">
				</div>
			</div>

		</form>



		</div>

	</div>

</div>

  </body>  
</html>