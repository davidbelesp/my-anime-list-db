<?php

$mysqli = new mysqli("localhost", "user", "password", "database");

if ($mysqli->connect_errno) {
   die("error de conexión: " . $mysqli->connect_error);
}
 
$sql = "UPDATE tabla SET columna = 'Valor' WHERE id = 1";

$mysqli->query($sql);

?>