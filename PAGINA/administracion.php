<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Imagen para el icono-->
    <link rel="icon" type="image/png" href="/recursos/images/cerebro.png" />

    <title>Administracion</title>
</head>
<body>

<?php
/* By http://php-estudios.blogspot.com */

/* PARTE 1: AL INICIO SE EXTRAEN TODAS LAS FILAS */
//Necesitamos establecer una conexión con la base de datos.
$mysql_usuario = "root";
$mysql_password = "";
$mysql_host = "localhost";
$mysql_database = "olivogonzalez";

//Datos de conexión
$conexion = new mysqli("localhost", "root", "", "olivogonzalez");

//Seleccionar la base datos y la conexión y capturar posibles errores con die
if($conexion->connect_errno)
{
    echo "Error de conexion de la base datos".$conexion->connect_error;
    exit();
}

//Preparar la consulta para extraer todos los clientes
$consulta = "SELECT * FROM usuarios";

//Ejecutar la consulta
$resultado = mysql_query($consulta, $conexion) or die(mysql_error());

//Extraer todas la filas y almacenarlas en una tabla
$table = "<table border='1' cellpadding='10'>\n";
$table .= "<tr><th>ID</th><th>Nombre</th><th>EMAIL</th>\n";
while($fila = mysql_fetch_assoc($resultado)){
$table .= "<tr>
      <td>".$fila["ID_USUARIO"]."</td>
      <td>".$fila["NOMBRE_USUARIO"]."</td>
      <td>".$fila["EMAIL"]."</td>
      <td><form method='post' action=''> \n
      <input type='hidden' name='id_cliente' value='".$fila["ID_USUARIO"]."'>
      <input type='submit' value='Eliminar'>
      </form></td>
   </tr>\n";
    }
$table .= "</table>\n";


/* PARTE 2: SI SE ENVÍA EL FORMULARIO CAPTURAR LOS DATOS PARA ELIMINAR EL CLIENTE */

if (isset($_POST["id_cliente"]))
{
//Se almacena en una variable el id del registro a eliminar
$id_cliente = $_POST["id_cliente"];

//Preparar la consulta
$consulta = "DELETE FROM usuarios WHERE ID_USUARIO=$id_cliente";

//Ejecutar la consulta
$resultado = mysql_query($consulta, $conexion) or die(mysql_error());

//redirigir nuevamente a la página para ver el resultado
header("location: eliminar.php");
}

?>

<!DOCTYPE HTML>
<html>
<head>
<title>Eliminar registros de una tabla con Mysql y PHP</title>
</head>
<body>

<?php

/* Mostrar la tabla con los registros */
echo $table;

?>

</body>
</html>

<?php
/* Cerrar la conexión */
mysql_close($conexion);
?>
</body>
</body>
</html>
