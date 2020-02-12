<?php
session_start();

require "conexion.php";

$postid = $_POST['id'];
$user = $_SESSION['id'];


$countLikes = $mysqli->query("SELECT * FROM likes WHERE usuario = '$user' AND post = '$postid'");
$cLike = $countLikes->num_rows;

if($cLike == 0) {
	$insertLike = $mysqli->query("INSERT INTO likes (usuario,post,fecha) VALUES ('$user', '$postid', now())");
	$updatePub = $mysqli->query("UPDATE publicaciones SET likes = likes+1 WHERE id = '$postid'");
} else {
	$insertLike = $mysqli->query("DELETE FROM likes WHERE usuario = '$user' AND post = '$postid'");
	$updatePub = $mysqli->query("UPDATE publicaciones SET likes = likes-1 WHERE id = '$postid'");	
}

if($cLike == 0) {
	$megusta = "<img src='images/icons/cora2.png'>";
} else {
	$megusta = "<img src='images/icons/cora.png'>";
}

$return = array("img"=>$megusta);

echo json_encode($return);