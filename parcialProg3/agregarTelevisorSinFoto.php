<?php
include_once "./clases/televisor.php";
$tipo=$_POST["tipo"];
$precio=$_POST["precio"];
$pais=$_POST["pais"];

$tel = new Televisor($tipo,$precio,$pais);
if($tel->Agregar())
{
    echo (json_encode(array("exito"=>true,"mensaje"=>"Se agrego correctamente")));
}
else
{
    echo (json_encode(array("exito"=>false,"mensaje"=>"No se pudo agregar")));

}