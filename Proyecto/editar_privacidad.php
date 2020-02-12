<?php
session_start();
if(!isset($_SESSION['logueado']) && $_SESSION['logueado'] == FALSE) {
  header("Location: index.php");
}

include "functions.php";
?>

<?php
	require "conexion.php";

	$sqlA = $mysqli->query("SELECT private_profile FROM users WHERE id = '".$_SESSION['id']."'");
	$rowA = $sqlA->fetch_array();
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
			<a href="editar_pass.php"><button class="button_edit">Cambiar contraseña</button></a> 
			<a href="editar_privacidad.php"><button class="button_edit_on">Privacidad y seguridad</button></a>
		</div>

		<form action="" method="post">

			<?php
				if(isset($_POST['editar'])) {
					require "conexion.php";

					$privado = $mysqli->real_escape_string($_POST['privado']);

					if($privado == "on") {$pri = 1;} else {$pri = 0;}

					$update = $mysqli->query("UPDATE users SET private_profile = '$pri' WHERE id = '".$_SESSION['id']."'");
					if($update) {header("Location: editar_privacidad.php");}
				}
			?>

		<div class="e-right">
			<div class="e-contenido">
				<div class="e-title">¿Perfil privado?</div>
				<?php
					if($rowA['private_profile'] == 1) {$act = "checked";} else {$act = "";}
				?>
				<div class="e-input"><input type="checkbox" name="privado" <?php echo $act; ?>>
				</div>
			</div>
			<div class="e-contenido">
				<div class="e-title"></div>
				<div class="e-but">
					<input type="submit" value="Editar" name="editar" class="button_blue" style="margin-left: 230px; margin-bottom: 30px; color: white; font-size: 16px; padding:6px 9px;font-weight: 600;">
				</div>
			</div>

		</form>



		</div>

	</div>

</div>

  </body>  
</html>