<?php
include_once "./clases/usuario.php";
$email=$_GET["email"];
if(isset($_COOKIE[$_GET["email"]]) != null)
{
    echo (json_encode(array("exito"=>true,"mensaje"=>$_COOKIE[$_GET["email"]])));
}
else
{
    /*
    $obj= new stdClass();
    $obj->exito=false;
    $obj->mensaje="no se encuentra la cookie";
    echo json_encode($obj);
    */
    echo (json_encode(array("exito"=>false,"mensaje"=>"no se encuentra la cookie")));

}