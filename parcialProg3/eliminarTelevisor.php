<?php
include_once "./clases/televisor.php";

if(isset($_GET["tipo"]))
{
    $ayuda=$_GET["tipo"];
    $flag=true;
    $conStr='mysql:host=localhost;dbname=productos_bd';
    try
    {
        $pdo=new PDO($conStr,'root',"");
        $sentenciaPreparada=$pdo->prepare("SELECT * FROM televisores WHERE tipo=:tipo");
        $sentenciaPreparada->execute(array("tipo"=>$ayuda));
        
        while($fila=$sentenciaPreparada->fetch(PDO::FETCH_ASSOC))
        {
            //var_dump($fila);
            if($fila["tipo"] == $_GET["tipo"])
            {
                $flag=false;
                echo "El tipo se encuentra en la base de datos";
                break;
            }
        }
        if($flag)
        {
            echo "El tipo no se encuentra en la base de datos";
        }
        
    }
    catch(PDOException $e)
    {
        echo "Error!!!\n" . $e->getMessage();
    }
}
if(isset($_POST["tipo"]) && isset($_POST["accion"]))
{
    if($_POST["accion"] == "borrar")
    {
        $conStr='mysql:host=localhost;dbname=productos_bd';
        try
        {
            $pdo=new PDO($conStr,'root',"");
            $sentenciaPreparada=$pdo->prepare("SELECT * FROM televisores WHERE tipo=:tipo");
            $sentenciaPreparada->execute(array("tipo"=>$_POST["tipo"]));
            while($fila=$sentenciaPreparada->fetch(PDO::FETCH_ASSOC))
            {
                $tel= new Televisor($fila["tipo"],$fila["precio"],$fila["pais"],$fila["foto"]);
                $pathViejo="./televisores/imagenes/".$fila["foto"];
                
                $extension=pathinfo($fila["foto"],PATHINFO_EXTENSION);
                $nombreNuevo=$fila["tipo"].".borrado.".$fila["pais"].".".$extension;
                $nuevoDestino="./televisores/eliminadas/".$nombreNuevo;
                if(rename($pathViejo,$nuevoDestino))
                {
                    $tel->Eliminar();
                }
                else
                {
                    echo "no se pudo eliminar";
                }
                

            }

        }
        catch(PDOException $e)
        {
            echo "Error!!!\n" . $e->getMessage();
        }
    }
}
