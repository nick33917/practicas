<?php
include_once "./clases/televisor.php";

$array=Televisor::Traer();
$tabla="<table border=1><tr><th>TIPO</th><th>PRECIO</th><th>PAIS</th><th>FOTO</th><th>PRECIO CON IVA</th></tr>";
foreach($array as $tel)
{
    $ubicacion= "televisores/imagenes/".$tel->path;
    $tabla.="<tr><td>".$tel->tipo."</td><td>".$tel->precio."</td><td>".$tel->paisOrigen."</td><td><image src=".$ubicacion." width=100 height=100></td><td>".$tel->CalcularIVA()."</td></tr>";
}
$tabla.="</table>";
echo $tabla;