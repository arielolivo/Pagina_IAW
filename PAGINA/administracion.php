<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Imagen para el icono-->
<link rel="icon" type="image/png" href="/recursos/images/cerebro.png" />

        <!--Css Formulario-->
<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="recursos/css/style_formulario.css">

    <title>Administracion</title>
</head>
<body>
<?php
$conexion = new mysqli("localhost", "root", "", "olivogonzalez");

if($conexion->connect_errno)
{
    echo "Error de conexion de la base datos".$conexion->connect_error;
    exit();
}
$sql = "select * from usuarios";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<div class="form">
    <h1 align="center">Usuarios registrados</h1>
    <table class="tabla">

    <tr align="center">
        <td>ID de usuario</td>
        <td>Nombre de usuario</td>
        <td>EMAIL</td>
        <td>Contraseña</td>
    </tr>
    <?php
        while($datos=$resultado->fetch_array()){
        ?>
            <tr>
                <td><?php echo $datos["ID_USUARIO"]?></td>
                <td><?php echo $datos["NOMBRE_USUARIO"]?></td>
                <td><?php echo $datos["EMAIL"]?></td>
                <td><?php echo $datos["CONTRASENA"]?></td>
            </tr>
            <?php
        }

     ?>
    </table>
</div>
</body>
</body>
</html>

<?php
$servername = "mysql.hostinger.com";
$database = "u266072517_name";
$username = "u266072517_user";
$password = "buystuffpwd";
$sql = "mysql:host=$servername;dbname=$database;";
$dsn_Options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
// Create a new connection to the MySQL database using PDO, $my_Db_Connection is an object
try {
  $my_Db_Connection = new PDO($sql, $username, $password, $dsn_Options);
  echo "Connected successfully";
} catch (PDOException $error) {
  echo 'Connection error: ' . $error->getMessage();
}
// Set the variables for the person we want to add to the database
$first_Name = "Thom";
$last_Name = "Vial";
$email = "thom.v@some.com";
// Here we create a variable that calls the prepare() method of the database object
// The SQL query you want to run is entered as the parameter, and placeholders are written like this :placeholder_name
$my_Insert_Statement = $my_Db_Connection->prepare("INSERT INTO Students (name, lastname, email) VALUES (:first_name, :last_name, :email)");
// Now we tell the script which variable each placeholder actually refers to using the bindParam() method
// First parameter is the placeholder in the statement above - the second parameter is a variable that it should refer to
$my_Insert_Statement->bindParam(:first_name, $first_Name);
$my_Insert_Statement->bindParam(:last_name, $last_Name);
$my_Insert_Statement->bindParam(:email, $email);
// Execute the query using the data we just defined
// The execute() method returns TRUE if it is successful and FALSE if it is not, allowing you to write your own messages here
if ($my_Insert_Statement->execute()) {
  echo "New record created successfully";
} else {
  echo "Unable to create record";
}
// At this point you can change the data of the variables and execute again to add more data to the database
$first_Name = "John";
$last_Name = "Smith";
$email = "john.smith@email.com";
$my_Insert_Statement->execute();
// Execute again now that the variables have changed
if ($my_Insert_Statement->execute()) {
  echo "New record created successfully";
} else {
  echo "Unable to create record";
