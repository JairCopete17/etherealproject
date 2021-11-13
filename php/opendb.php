<?php
$servidor = "localhost";
$usuario = "root";
$pass = "";
$bd = "ethereal";

$db = new mysqli($servidor, $usuario, $pass, $bd);

if ($db->connect_errno) {
	echo "Nuestro sitio experimenta fallos";
	exit();
}
?>