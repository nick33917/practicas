<?php
include_once "./clases/usuario.php";

$email=$_POST["email"];
$clave=$_POST["clave"];
$usr = new Usuario($email,$clave);
echo ($usr->guardarEnArchivo());
?>