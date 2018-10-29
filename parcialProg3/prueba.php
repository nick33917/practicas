<?php
include_once "./clases/usuario.php";
//include_once "./clases/televisor.php";

$usr1 = new Usuario("marcelo","123");
$usr2 = new Usuario("jorge","456");
$usr3 = new Usuario("pedro","789");
$usr4 = new Usuario("pedrii","789");

$str="muestro al empleado 1";
echo ($str);
echo ($usr1->toJson());
echo ("------------------<br>");


echo $usr1->guardarEnArchivo();

/*
$usr2->guardarEnArchivo();
$usr3->guardarEnArchivo();


$array=Usuario::traerTodos();
foreach($array as $usr)
{
    echo ($usr->toJson());
}
echo ("<br>");
if(Usuario::verificarExistencia($usr3))
{
    echo "el mail se encuentra";
}
else
{
    echo "el mail no se encuentra";
}
*/
/*
$tel1=new Televisor("hitachi",1500,"china","hhh");
$tel2=new Televisor("philips",2500,"japon","ppp");
$tel3=new Televisor("sanyo",3500,"chingolo","sss");

//$tel2->Agregar();
//$tel3->Agregar();
//$array=Televisor::Traer();
//var_dump($array);
echo $tel3->CalcularIVA();

*/
?>