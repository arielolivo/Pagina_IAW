<html>
      <head>
         <title>Ejemplo de borrado de datos en base de datos MySQL</title>
      </head>

      <body>

      <?php

      // Dirección o IP del servidor MySQL
      $host = "localhost";

      // Nombre de usuario del servidor MySQL
      $usuario = "root";

      // Contraseña del usuario
      $contrasena = "";

      // Nombre de la base de datos
      $baseDeDatos ="olivogonzalez";

      // Nombre de la tabla a trabajar
      $tabla = "usuarios";

      function Conectarse()
      {
         global $host, $usuario, $contrasena, $baseDeDatos, $tabla;

         if (!($link = mysqli_connect($host, $usuario, $contrasena)))
         {
            echo "Error conectando a la base de datos.<br>";
            exit();
            }
         else
         {
            echo "Listo, estamos conectados.<br>";
         }
         if (!mysqli_select_db($link, $baseDeDatos))
         {
            echo "Error seleccionando la base de datos.<br>";
            exit();
         }
         else
         {
            echo "Obtuvimos la base de datos $baseDeDatos sin problema.<br>";
         }
      return $link;
      }

      $link = Conectarse();
////////////////////////////////
//////////PHP PARA BORRAR///////
////////////////////////////////
      if($_GET)
      {
         $queryDelete = "DELETE FROM $tabla WHERE ID_USUARIO = ".$_GET['ida'].";";

         $resultDelete = mysqli_query($link, $queryDelete);

         if($resultDelete)
         {
            echo "<strong>El registro se ha eliminado con exito</strong>.<br>";
         }
         else
         {
            echo "Hubo un problema borrando el registro.";
         }
      }
////////////////////////////////
//////////PHP PARA EDITAR///////
////////////////////////////////
      if($_POST)
      {
         $queryUpdate = "UPDATE $tabla SET NOMBRE_USUARIO = '".$_POST['nombreForm']."',
                        EMAIL = '".$_POST['apellidoForm']."'
                        WHERE ID_USUARIO = ".$_POST['idForm'].";";

         $resultUpdate = mysqli_query($link, $queryUpdate);

         if($resultUpdate)
         {
            echo "<strong>El registro ID ".$_POST['idForm']." con exito</strong>. <br>";
         }
         else
         {
            echo "No se pudo actualizar el registro. <br>";
         }

      }
///////////////////////////////////////////////

      $query = "SELECT ID_USUARIO, NOMBRE_USUARIO, EMAIL FROM $tabla;";

      $result = mysqli_query($link, $query);

      ?>

      <table>
         <tr>
            <td>ID</td>
            <td>Nombre</td>
            <td>EMAIL</td>
         <tr>

      <?php

      while($row = mysqli_fetch_array($result))
      {
         echo "<tr>";
         echo "<td>";
         echo $row["ID_USUARIO"];
         echo "</td>";
         echo "<td>";
         echo $row["NOMBRE_USUARIO"];
         echo "</td>";
         echo "<td>";
         echo $row["EMAIL"];
         echo "</td>";
         echo "<td>";
         echo "<a href=\"?ida=".$row["ID_USUARIO"]."\">Borrrar</a>";
         echo "</td>";
         echo "<td>";
         echo "<a href=\"?id=".$row["ID_USUARIO"]."\">ACTUALIZAR</a>";
         echo "</td>";
         echo "</tr>";

      }

      mysqli_free_result($result);

      mysqli_close($link);

      ?>

      </table>
      <hr>




      http://tutorialphp.net/bases-de-datos-mysql-en-php-7/actualizar-registros-de-base-de-datos-mysql-en-php-7/



<!--actualizar-->

      </body>
      </html>


