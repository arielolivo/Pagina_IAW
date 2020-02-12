<?php

function datos_usuario($id,$value) {

	require "conexion.php";

	$id = $mysqli->real_escape_string($id);
	$value = $mysqli->real_escape_string($value);

	$datosZ = $mysqli->query("SELECT * FROM users WHERE id = $id");
	$rowZ = $datosZ->fetch_array();

	echo $rowZ[$value];

}

?>