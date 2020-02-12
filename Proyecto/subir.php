<?php
ob_start();
session_start();
if(!isset($_SESSION['logueado']) && $_SESSION['logueado'] == FALSE) {
  header("Location: index.php");
}
error_reporting(0);
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 

    <script type="text/javascript">
    $(window).load(function(){
     $(function() {
      $('#file-input').change(function(e) {
          addImage(e); 
         });

         function addImage(e){
          var file = e.target.files[0],
          imageType = /image.*/;
        
          if (!file.type.match(imageType))
           return;
      
          var reader = new FileReader();
          reader.onload = fileOnload;
          reader.readAsDataURL(file);
         }
      
         function fileOnload(e) {
          var result=e.target.result;
          $('#imgSalida').attr("src",result);
         }
        });
      });
    </script>

    <script>
      function capturar()
      {
            var resultado="";
     
            var porNombre=document.getElementsByName("filter");
            for(var i=0;i<porNombre.length;i++)
            {
                if(porNombre[i].checked)
                    resultado=porNombre[i].value;
            }

        var elemento = document.getElementById("resultado");
        if (elemento.className == "") {
          elemento.className = resultado;
          elemento.width = "600";
        }else {
          elemento.className = resultado;
          elemento.width = "600";
        }
    }
    </script>
  </head>  

<?php include "header.php"; ?>

<form action="" method="post" enctype="multipart/form-data">  

  <div class="hl-icon" style="margin-left: 49%;">
    <div class="image-upload">
        <label for="file-input">
          <img src="images/icons/mas.png" width="50" title ="Sube una foto ó video" >
        </label>
        <input id="file-input" type="file" name="file-input" hidden="" />
    </div>
  </div>

<body onload="capturar()">

<div style="float: left; margin-left: 3%;">
  <div class="imgcheck">
    <label>
      <input type="radio" name="filter" value="" onclick="capturar()">
      <img src="images/filtro.jpg" class="" width="150">
    </label>
  </div>
  <div class="imgcheck">
    <label>
      <input type="radio" name="filter" value="reyes" onclick="capturar()">
      <img src="images/filtro.jpg" class="reyes" width="150">
    </label>
  </div>
  <div class="imgcheck">
    <label>
      <input type="radio" name="filter" value="sierra" onclick="capturar()">
      <img src="images/filtro.jpg" class="sierra" width="150">
    </label>
  </div>
  <div class="imgcheck">
    <label>
      <input type="radio" name="filter" value="gingham" onclick="capturar()">
      <img src="images/filtro.jpg" class="gingham" width="150">
    </label>
  </div>
  <div class="imgcheck">
    <label>
      <input type="radio" name="filter" value="stinson" onclick="capturar()">
      <img src="images/filtro.jpg" class="stinson" width="150">
    </label>
  </div>
  <div class="imgcheck">
    <label>
      <input type="radio" name="filter" value="maven" onclick="capturar()">
      <img src="images/filtro.jpg" class="maven" width="150">
    </label>
  </div>
  <div class="imgcheck">
    <label>
      <input type="radio" name="filter" value="kelvin" onclick="capturar()">
      <img src="images/filtro.jpg" class="kelvin" width="150">
    </label>
  </div>
  <div class="imgcheck">
    <label>
      <input type="radio" name="filter" value="Lo-Fi" onclick="capturar()">
      <img src="images/filtro.jpg" class="Lo-Fi" width="150">
    </label>
  </div>
  <div class="imgcheck">
    <label>
      <input type="radio" name="filter" value="moon" onclick="capturar()">
      <img src="images/filtro.jpg" class="moon" width="150">
    </label>
  </div>
</div>

 
<div style="float: left; clear: both; width: 600px; margin-left: 30%;">
  <div id="resultado" class=""><img id="imgSalida" width="600" /></div>
</div>

<div style="float: left; clear: both; margin-top: 30px; margin-bottom: 30px; margin-left: 24%;">
  <textarea rows="6" cols="100%" name="descripcion" placeholder="Descripción de tu publicación"></textarea>
</div>

<div style="float: left; clear: both; margin-left: 45%;">
  <input name="submit" type="submit" class="myButton" value="Compartir">   
</div>
</form>  

<?php  
if (isset($_POST['submit'])) {  

  require "conexion.php";

  $imagen = $_FILES['file-input']['tmp_name'];   
  $imagen_tipo = exif_imagetype($_FILES['file-input']['tmp_name']);

  if ($imagen_tipo == IMAGETYPE_PNG OR $imagen_tipo == IMAGETYPE_JPEG OR $imagen_tipo == IMAGETYPE_BMP) {

  $filtro = $mysqli->real_escape_string($_POST['filter']);
  $descripcion = $mysqli->real_escape_string($_POST['descripcion']);

    if(is_uploaded_file($_FILES['file-input']['tmp_name'])) { 

        $result = $mysqli->query("SHOW TABLE STATUS WHERE `Name` = 'archivos'");
        $data = $result->fetch_assoc();
        $next_id = $data['Auto_increment'];

        $ext = ".jpg"; 
        $namefinal = trim ($_FILES['file-input']['name']);
        $namefinal = str_replace (" ", "", $namefinal);
        $aleatorio = substr(strtoupper(md5(microtime(true))), 0,6);
        $namefinal = 'ID-'.$next_id.'-NAME-'.$aleatorio; 

        if ($imagen_tipo == IMAGETYPE_PNG) {
          $image = imagecreatefrompng($imagen);
          imagejpeg($image, 'archivos/'.$namefinal.$ext, 100);           

          $nuevaimagen = 'archivos/'.$namefinal.$ext;
        }

        else {
          $nuevaimagen = $imagen;
        }

        $original = imagecreatefromjpeg($nuevaimagen);
        $max_ancho = 1080; $max_alto = 1080;
        list($ancho,$alto)=getimagesize($nuevaimagen);

        $x_ratio = $max_ancho / $ancho;
        $y_ratio = $max_alto / $alto;

        if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
            $ancho_final = $ancho;
            $alto_final = $alto;
        }
        else if(($x_ratio * $alto) < $max_alto){
            $alto_final = ceil($x_ratio * $alto);
            $ancho_final = $max_ancho;
        }
        else {
            $ancho_final = ceil($y_ratio * $ancho);
            $alto_final = $max_alto;
        }

        $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 

        imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
         
        imagedestroy($original);

        imagejpeg($lienzo,"archivos/".$namefinal.$ext);

      }


        if($_FILES['file-input']['tmp_name']) {

          $queryp = $mysqli->query("INSERT INTO publicaciones (user,descripcion,fecha) VALUES ('".$_SESSION['id']."','".$descripcion."',now())");

          $ultpub = $mysqli->query("SELECT id FROM publicaciones WHERE user = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1");
          $ultp = $ultpub->fetch_array();

          $query = "INSERT INTO archivos (user,ruta,tipo,size,publicacion,filtro,fecha) VALUES ('".$_SESSION['id']."','".$namefinal.$ext."','".$_FILES['file-input']['type']."','".$_FILES['file-input']['size']."','".$ultp['id']."','".$filtro."',now())";

       $mysqli->query($query); 

       if($query) {header("refresh: 0; url = home.php");}
        }  
    }  

     else {echo "<script type='text/javascript'>alert('Solo puedes subir imágenes');</script>";}
 } 
?> 
  </body>  
</html>