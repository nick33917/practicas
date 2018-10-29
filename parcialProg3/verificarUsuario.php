<?php
include_once "./clases/usuario.php";
$email=$_POST["email"];
$clave=$_POST["clave"];
$usr = new Usuario($email,$clave);
if(Usuario::verificarExistencia($usr))
{
    setcookie($email,date("H:i:s"));
    //echo ($_COOKIE[$email]);
    header("location:listadoUsuarios.php");
}
else
{
    /*
    $obj = new stdClass;
    $obj->exito=false;
    $obj->str="no se encuentra en el archivo USUARIOS.JSON";
    echo json_encode($obj);
    */
    echo (json_encode(array("exito"=>false,"mensaje"=>"no se encuentra en el archivo USUARIOS.JSON")));
}

?>