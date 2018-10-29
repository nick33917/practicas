<?php
include_once "./clases/televisor.php";
$tipo=$_POST["tipo"];
$precio=$_POST["precio"];
$pais=$_POST["pais"];
$foto=$_FILES["path"]["name"];

$extension = pathinfo($foto,PATHINFO_EXTENSION);
$nuevoNombre=$tipo."-".$pais.".".$extension;
$destino="./televisores/imagenes/" .$nuevoNombre;
if(move_uploaded_file($_FILES["path"]["tmp_name"],$destino))
{
    $tel = new Televisor($tipo,$precio,$pais,$nuevoNombre);
    if($tel->Agregar())
    {
        echo (json_encode(array("exito"=>true,"mensaje"=>"Se agrego correctamente")));
    }
    else
    {
        echo (json_encode(array("exito"=>false,"mensaje"=>"No se pudo agregar")));
    }

}

