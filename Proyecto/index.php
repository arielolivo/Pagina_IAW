<!DOCTYPE html>
<html lang="es">
<head>
  <title>Photogram</title>
  <!--Css normal-->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css" type="text/css">
  <!--Css para la imagenes-->
       
  <link rel="stylesheet" type="text/css" href="prueba/css/demo.css" />
        <link rel="stylesheet" type="text/css" href="prueba/css/style.css" />
        <link rel="stylesheet" type="text/css" href="prueba/css/normalize.css" />
		<script type="text/javascript" src="prueba/js/modernizr.custom.79639.js"></script> 
</head>

<body>

  <div id="wrapper">

    <div class="w-center" >
    
    <section class="main">
			
      <div class="ia-container">
      
        <figure>
          <img src="prueba/images/1.jpg" alt="image01" />
          <input type="radio" name="radio-set" checked="checked"/>
          <figcaption><span>True Colors</span></figcaption>
          
          <figure>
            <img src="prueba/images/2.jpg" alt="image02" />
            <input type="radio" name="radio-set" />
            <figcaption><span>Honest Light</span></figcaption>
            
            <figure>
              <img src="prueba/images/3.jpg" alt="image03" />
              <input type="radio" name="radio-set" />
              <figcaption><span>Silent Serenity</span></figcaption>
              
              <figure>
                <img src="prueba/images/4.jpg" alt="image04" />
                <input type="radio" name="radio-set" />
                <figcaption><span>Warm Welcome</span></figcaption>
                
                <figure>
                  <img src="prueba/images/5.jpg" alt="image05" />
                  <input type="radio" name="radio-set" />
                  <figcaption><span>Sensible Magic</span></figcaption>
                  
                  <figure>
                    <img src="prueba/images/6.jpg" alt="image06" />
                    <input type="radio" name="radio-set" />
                    <figcaption><span>Lovely Midnight</span></figcaption>
              
                    <figure>
                      <img src="prueba/images/7.jpg" alt="image07" />
                      <input type="radio" name="radio-set" />
                      <figcaption><span>Illuminated Darkness</span></figcaption>											

                      <figure>
                        <img src="prueba/images/8.jpg" alt="image08" />
                        <input id="ia-selector-last" type="radio" name="radio-set" />
                        <figcaption><span>Happy Child</span></figcaption>
                      </figure>
                      
                    </figure>
              
                  </figure>	
                    
                </figure>	
                  
              </figure>
                
            </figure>
            
          </figure>
          
        </figure>
        
      </div><!-- ia-container -->
      
    </section>
    
    </div>

    <div class="w-center">

      <?php
      if(isset($_GET['error'])) {
        echo "<center>Error el usuario o contraseña no coinciden</center>";
      }
      ?>

      <?php
      if(isset($_POST['entrar'])) {

        require("conexion.php");

        $username = $mysqli->real_escape_string($_POST['usuario']);
        $password = $_POST['password'];

        $consulta = "SELECT username,password,id FROM users WHERE username = '$username' AND password = '$password'";

        if($resultado = $mysqli->query($consulta)) {
          while($row = $resultado->fetch_array()) {

            $userok = $row['username'];
            $passok = $row['password'];
            $id = $row['id'];
          }
          $resultado->close();
        }
        $mysqli->close();


        if(isset($username) && isset($password)) {

          if($username == $userok && $password == $passok) {

            session_start();
            $_SESSION['logueado'] = TRUE;
            $_SESSION['username'] = $userok;
            $_SESSION['id'] = $id;
            header("Location: home.php");

          }

          else {

            Header("Location: index.php?error=login");

          }

        }


      }
      ?>

      <div class="main-content">
        <div class="header">
          <img src="images/logo.png">
        </div>
        <div class="formul">
          <form action="" method="post">
            <input type="text" placeholder="Usuario" class="input" name="usuario" autocomplete="off" />
            <div class="overlap-text">
              <input type="password" placeholder="Contraseña" class="input" name="password" />
            </div>
            <input type="submit" value="Entrar" class="prueba"  name="entrar" />
            <input type="submit" value="Entrar como Invitado"  class="prueba" name="entrarinvitado" />
          </form>
        </div>
      </div>

      <div class="sub-content">
        <div class="s-part">
          ¿No tienes una cuenta? <a href="registro.php">Regístrate</a>
        </div>

  </div>

</body>
</html>
<?php
ob_end_flush();
?>
