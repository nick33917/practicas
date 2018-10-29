<?php
include_once "./clases/usuario.php";
$array=Usuario::traerTodos();
$arrayJson="[";
foreach($array as $empl)
{
   $arrayJson.= $empl->toJson() .",";
}
$arrayJson= substr($arrayJson,0,-1);
$arrayJson.="]";
var_dump($arrayJson);


