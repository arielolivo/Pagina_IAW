<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="Imagenport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Galeria</title>
    <link rel="stylesheet" href="Recursos/galeria.css">
</head>
<body>
    <?php
session_start();
$_SESSION["Nombre"]="Administrador";
if(array_key_exists('Nombre', $_SESSION) && $_SESSION["Nombre"] == "Administrador")  {
    header('Location:administracion.php');
};
?>
    <div class="Contenedor">
        <!--Barra superior-->
        <div class="Search">
            <ul>
                <li>
                    <form action="galeria.php" method="post">
                        <input type="text" placeholder="Autor" name="autor" id="autor"/>
                </li>
                <li>
                        <input type="submit" name="buscar" id="buscar" value="Buscar"/>
                    </form>
                </li>
                <li>
                    <button>Cerrar sesión</button>
                </li>
                <li>
                    <!--Aqui irá el usuario si esta logeado-->
                    <span>
                        <?php
                            if(array_key_exists('Nombre', $_SESSION))  {
                                echo $_SESSION["Nombre"];
                            } else {
                                echo '<a href="index.php">Registrarse</a>';
                            };
                        ?>
                    </span>
                </li>
            </ul>
        </div>
        <!--Contenedor de imagenes-->
<?php
    echo '<div class="Galeria">';
    //campos de la base de datos:
    //Usuarios: ID_USUARIO, NOMBRE_USUARIO, EMAIL, CONTRASENA
    //Contribuciones: ID_CONTRIBUCION, ID_AUTOR, NOMBRE_IMAGEN, PIE_DE_FOTO

    //Base de datos
    $DIRECCION = "127.0.0.1";
    $USUARIO = "root";
    $CONTRASENA = "";
    $DATOS = "olivogonzalez";
    //Conexion a la base de datos
    $connect=mysqli_connect($DIRECCION, $USUARIO, $CONTRASENA, $DATOS) or die("Error.");

    // Si hay una busqueda de autor
    if (isset($_REQUEST["autor"]) && !empty($_REQUEST["autor"])) {
        $autor=trim(htmlspecialchars($_REQUEST["autor"], ENT_QUOTES, "UTF-8"));
    }

    //Si el autor esta en la busqeda lo selecciona
    if (!isset($autor)) {
        // registro sin autor buscado
        $registro=mysqli_query($connect, "SELECT c.NOMBRE_IMAGEN,c.PIE_DE_FOTO,u.NOMBRE_USUARIO FROM USUARIOS u INNER JOIN CONTRIBUCIONES c ON u.ID_USUARIO = c.ID_AUTOR ORDER BY Fecha_de_subida") or die("Error.".mysqli_error($connect));
    } else {
        // registro con autor buscado
        $registro=mysqli_query($connect, "SELECT c.NOMBRE_IMAGEN,c.PIE_DE_FOTO,u.NOMBRE_USUARIO FROM USUARIOS u INNER JOIN CONTRIBUCIONES c ON u.ID_USUARIO = c.ID_AUTOR WHERE u.NOMBRE_USUARIO LIKE '$autor' ORDER BY Fecha_de_subida") or die("Error.".mysqli_error($connect));
    }

    // presentación de la imagen, esta debe estar en el directorio
    while($reg=mysqli_fetch_array($registro)){
        //div que contiene la imagen
        echo '<div class="Imagen">';
        echo    '<img src="Usuarios\\'.$reg['NOMBRE_USUARIO'].'\\'.$reg['NOMBRE_IMAGEN'].'.png" />';
        //div que oculta la imagen con la información
        echo    '<div class="mask">';
        echo        '<h2>'.$reg['NOMBRE_USUARIO'].'</h2>';
        echo        '<p>'.$reg['PIE_DE_FOTO'].'</p>';
        echo        '<a href="galeria.php?autor='.$reg['NOMBRE_USUARIO'].'">'.$reg['NOMBRE_USUARIO'].'</a>';
        echo    '</div>';
        echo '</div>';
    }
    echo '</div>';
?>
    </div>
</body>
</html>
