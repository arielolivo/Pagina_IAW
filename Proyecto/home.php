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
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="js/likes.js"></script>
    <script src="js/favoritos.js"></script>
  </head>  
  <body>   

<?php
require("conexion.php");

$consultaA = "SELECT confirmed FROM users WHERE username = '".$_SESSION['username']."'";
$resultadoA = $mysqli->query($consultaA);
$row = $resultadoA->fetch_array();

if($row['confirmed'] == 0) {
	echo "<div class='topbarc'><a href='codigo.php'>Confirma tu email aquí </a></div>";
}

$mysqli->close();
?> 

<?php include "header.php"; ?>

<div class="h-content">
	<div class="h-left">

		<?php
		require "conexion.php";

		$sqlA = $mysqli->query("SELECT * FROM publicaciones ORDER BY id DESC");
		while($rowA = $sqlA->fetch_array()) {
			$sqlB = $mysqli->query("SELECT * FROM users WHERE id = '".$rowA['user']."'");
				$rowB = $sqlB->fetch_array();
			$sqlC = $mysqli->query("SELECT * FROM archivos WHERE publicacion = '".$rowA['id']."'");
				$rowC = $sqlC->fetch_array();

			$countLikes = $mysqli->query("SELECT * FROM likes WHERE usuario = '".$_SESSION['id']."' AND post = '".$rowA['id']."'");
			$cLikes = $countLikes->num_rows;

			$countLikes2 = $mysqli->query("SELECT * FROM favoritos WHERE usuario = '".$_SESSION['id']."' AND post = '".$rowA['id']."'");
			$cLikes2 = $countLikes2->num_rows;
		?>

			<div class="hl-cont">
				<div class="hl-top">
					<div class="hl-profile">
						<div class="hl-pic"><a href="perfil.php?username=<?php echo $rowB['username'];?>"><img src="images/<?php echo $rowB['avatar']; ?>" width="50" height="50"></a></div>
					</div>
					<div class="hl-username">
						<div class="hl-name"><a href="perfil.php?username=<?php echo $rowB['username'];?>"><?php echo $rowB['username']; ?></a></div>
						<div class="hl-location">location</div>
					</div>
				</div>	
				<div class="hl-middle">
					<img src="archivos/<?php echo $rowC['ruta']; ?>" width="100%" class="<?php echo $rowC['filtro']; ?>">
				</div>	
				<div class="hl-section-likes">

					<?php if($cLikes == 0) { ?>
						<div id="<?php echo $rowA['id']; ?>" class="like" style="float: left; cursor: pointer;"><img src="images/icons/cora.png"></div>
					<?php } else { ?>
						<div id="<?php echo $rowA['id']; ?>" class="like" style="float: left; cursor: pointer;"><img src="images/icons/cora2.png"></div>
					<?php } ?>

					<div style="float: left;"><img src="images/icons/comentario.png"></div>

					<?php if($cLikes == 0) { ?>
						<div id="FAV<?php echo $rowA['id']; ?>" class="fav" style="float: left;"><img src="images/icons/favorito.png"></div>
					<?php } else { ?>
						<div id="FAV<?php echo $rowA['id']; ?>" class="fav" style="float: left;"><img src="images/icons/favorito2.png"></div>
					<?php } ?>

				</div>	
				<div class="hl-bottom">
					<strong style="color: #262626;"><?php echo $rowB['username']; ?></strong> <?php echo $rowA['descripcion']; ?>
				</div>			
			</div>

		<?php } ?>

	</div>


	<div class="h-right">		

		<div class="hl-menu">
			<div class="hl-icon"><img src="images/icons/lupa.png" width="50"></div>
			<div class="hl-icon"><a href="subir.php"><img src="images/icons/mas.png" width="50" title ="Sube una foto ó video" ></a></div>
			<div class="hl-icon"><img src="images/icons/corazon.png" width="50"></div>
		</div>
		
		<div class="hr-top">
			<div class="hr-profile">
				<div class="hr-pic"><a href="perfil.php?username=<?php echo $_SESSION['username'];?>"><img src="images/<?php datos_usuario($_SESSION['id'],'avatar'); ?>" width="60" height="60"></a></div>
			</div>
				<div class="hr-username">
					<div class="hr-name"><a href="perfil.php?username=<?php echo $_SESSION['username'];?>"><?php echo $_SESSION['username'];?></a></div>
				<div class="hr-nombre"><?php datos_usuario($_SESSION['id'],'name'); ?></div>
			</div>	
		</div>	
	</div>
</div>



  </body>  
</html>