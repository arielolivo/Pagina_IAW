<?php
ob_start();
?>
<?php
session_start();
if(isset($_SESSION['logueado']) && $_SESSION['logueado'] == TRUE) {
  header("Location: galeria.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Olivo_Gonzalez</title>

  <!--Imagen para el icono-->
  <link rel="icon" type="image/png" href="/recursos/images/cerebro.png" />

  <!--Css Formulario-->
<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="recursos/css/style_formulario.css">

  <!--Css para la imagenes-->
  <link rel="stylesheet" type="text/css" href="recursos/css/demo.css" />
        <link rel="stylesheet" type="text/css" href="recursos/css/style.css" />
        <link rel="stylesheet" type="text/css" href="recursos/css/normalize.css" />
		<script type="text/javascript" src="recursos/js/modernizr.custom.79639.js"></script>
</head>

<body>
  <div id="wrapper">
    <div class="w-center" >
    <section class="main">
      <div class="ia-container">
        <figure>
          <img src="recursos/images/1.jpg" alt="image01" />
          <input type="radio" name="radio-set" checked="checked"/>
          <figcaption><span>True Colors</span></figcaption>

          <figure>
            <img src="recursos/images/2.jpg" alt="image02" />
            <input type="radio" name="radio-set" />
            <figcaption><span>Honest Light</span></figcaption>

            <figure>
              <img src="recursos/images/3.jpg" alt="image03" />
              <input type="radio" name="radio-set" />
              <figcaption><span>Silent Serenity</span></figcaption>

              <figure>
                <img src="recursos/images/4.jpg" alt="image04" />
                <input type="radio" name="radio-set" />
                <figcaption><span>Warm Welcome</span></figcaption>

                <figure>
                  <img src="recursos/images/5.jpg" alt="image05" />
                  <input type="radio" name="radio-set" />
                  <figcaption><span>Sensible Magic</span></figcaption>

                  <figure>
                    <img src="recursos/images/6.jpg" alt="image06" />
                    <input type="radio" name="radio-set" />
                    <figcaption><span>Lovely Midnight</span></figcaption>

                    <figure>
                      <img src="recursos/images/7.jpg" alt="image07" />
                      <input type="radio" name="radio-set" />
                      <figcaption><span>Illuminated Darkness</span></figcaption>

                      <figure>
                        <img src="recursos/images/8.jpg" alt="image08" />
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
      </div><!-- cierra el div que contiene todos los figure -->
    </section>
    </div>

    <div class="w-center">

    <?php
//-----------------------------
//PHP para los registros
//----------------------------
    if(isset($_POST['registro'])) {

      require("conexion.php");

      $email = $mysqli->real_escape_string($_POST['mail']);
      $usuario = $mysqli->real_escape_string($_POST['usuario']);
      $password = md5($_POST['password']);

      $consultausuario = "SELECT NOMBRE_USUARIO FROM usuarios WHERE NOMBRE_USUARIO = '$usuario'";
      $consultaemail = "SELECT EMAIL FROM usuarios WHERE EMAIL = '$email'";

      if($resultadousuario = $mysqli->query($consultausuario));
      $numerousuario = $resultadousuario->num_rows;

      if($resultadoemail = $mysqli->query($consultaemail));
      $numeroemail = $resultadoemail->num_rows;

      if($numeroemail>0) {
        echo "<div class='alert'>";
        echo "<p>Este correo ya esta registrado, intenta con otro</p>";
        echo "</div>";










      }

      elseif($numerousuario>0) {
        echo "Este usuario ya existe";
      }

      else {

        $aleatorio = uniqid();

        $query = "INSERT INTO usuarios (EMAIL,NOMBRE_USUARIO,CONTRASENA) VALUES ('$email','$usuario','$password')";

        if($registro = $mysqli->query($query)) {

          Header("Refresh: 2; URL=index.php");
          echo "<div>";
          echo "<div class='alert'>";
          echo "<p>Felicidades $usuario se ha registrado correctamente.</p>";
          echo "</div>";
          echo "</div>";





        }

        else {

          echo "Ha ocurrido un error en el registro, intentelo de nuevo";
          header("Refresh: 2; URL=registro.php?error=registro");

        }


      }

      $mysqli->close();

    }
    ?>

  <?php

      if(isset($_GET['error'])) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>"Error el usuario o contraseña no coinciden"</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">x</span>
                </button>
              </div>';
      }
      ?>

      <?php
//-----------------------------
//PHP para el inicio de sesion
//----------------------------
      if(isset($_POST['entrar'])) {

        require("conexion.php");

        $username = $mysqli->real_escape_string($_POST['usuario']);
        $password = md5($_POST['password']);

        $consulta = "SELECT NOMBRE_USUARIO,CONTRASENA,ID_USUARIO FROM usuarios WHERE NOMBRE_USUARIO = '$username' AND CONTRASENA = '$password'";

        if($resultado = $mysqli->query($consulta)) {
          while($row = $resultado->fetch_array()) {

            $userok = $row['NOMBRE_USUARIO'];
            $passok = $row['CONTRASENA'];
            $id = $row['ID_USUARIO'];
          }
          $resultado->close();
        }
        $mysqli->close();


        if(isset($username) && isset($password)) {

          if($username == $userok && $password == $passok) {

            session_start();
            $_SESSION['logueado'] = TRUE;
            $_SESSION['NOMBRE_USUARIO'] = $userok;
            $_SESSION['ID_USUARIO'] = $id;
            header("Location: galeria.php");

          }

          else {

            Header("Location: index.php?error=login");

          }

        }


      }
      ?>

<!------------------------------------->
<!--Empieza el formulario de registro-->
<!------------------------------------->

<div class="form">

      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Registrate</a></li>
        <li class="tab"><a href="#login">Inicia sesion</a></li>
      </ul>

      <div class="tab-content">
        <div id="signup">
          <h1>Registrate es gratis</h1>

          <form action="" method="post">


          <div class="field-wrap">
            <label>
              Nombre de usuario<span class="req">*</span>
            </label>
            <input type="text" name="usuario" required />
          </div>

          <div class="field-wrap">
            <label>
              Correo<span class="req">*</span>
            </label>
            <input type="email"  name="mail" required />
          </div>


          <div class="field-wrap">
            <label>
              Establece una contraseña<span class="req">*</span>
            </label>
            <input type="password" name="password" required />
          </div>

          <button type="submit" name="registro" id="prueba" class="button button-block"/>Registrame</button>

          </form>

        </div>
<!--------------------------------------------->
<!--Empieza el formulario de Inicio de sesion-->
<!--------------------------------------------->
        <div id="login">
          <h1>Bienvenido de Nuevo</h1>

          <form action="" method="post"> <!-- Abre el formulario -->
            <div class="field-wrap">
            <label>
              Usuario<span class="req">*</span>
            </label>
            <input type="text" name="usuario" autocomplete="off" />
          </div>

          <div class="field-wrap">
            <label>
              Contraseña<span class="req">*</span>
            </label>
            <input type="password" class="input" name="password" />
          </div>
          <input type="submit" class="button button-block" value="Entrar" class="btn" name="entrar" />

          </form> <!-- cierra el formulario -->

        </div>

      </div><!-- Cierra el div que engloba todo el formulario tanto el del registro como el del iniciar sesion -->

</div> <!-- cierra el div que esta antes del form-->

<!-- El script para el formulario -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script  src="recursos/js/script.js"></script>
<!-------------------------------------->
</body>
</html>
<?php
ob_end_flush();
?>