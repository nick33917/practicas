<?php
include_once "IParte2.php";
class Televisor implements IParte2
{
    public $tipo;
    public $precio;
    public $paisOrigen;
    public $path;

    public function __construct($tipo1="",$precio1=0,$paisOrigen1="",$path1="")
    {
        $this->tipo=$tipo1;
        $this->precio=$precio1;
        $this->paisOrigen=$paisOrigen1;
        $this->path=$path1;
    }
    
    public function toJson()
    {
        return json_encode(array("tipo"=>$this->tipo,"precio"=>$this->precio,"paisOrigen"=>$this->paisOrigen,"path"=>$this->path));
    }

    public function Agregar()
    {
        $conStr='mysql:host=localhost;dbname=productos_bd';
        try
        {
            $pdo=new PDO($conStr,'root',"");
            $sentenciaPreparada=$pdo->prepare("INSERT INTO televisores (tipo,precio,pais,foto) VALUES (:tipo,:precio,:pais,:foto)");
            $flag=$sentenciaPreparada->execute(array("tipo"=>$this->tipo,"precio"=>$this->precio,"pais"=>$this->paisOrigen,"foto"=>$this->path));
            //echo "se agrego correctamente a la base de datos <br>";
            return $flag;
        }
        catch(PDOException $e)
        {
            echo "Error!!!\n" . $e->getMessage();
        }

    }

    public static function Traer()
    {
        $televisores=array();
        $conStr='mysql:host=localhost;dbname=productos_bd';
        try
        {
            $pdo=new PDO($conStr,'root',"");
            $sentenciaPreparada=$pdo->prepare("SELECT * FROM televisores");
            $sentenciaPreparada->execute();
            //probar este o usar fetch con un while
            while($fila=$sentenciaPreparada->fetch(PDO::FETCH_ASSOC))
            {
                $tele= new Televisor($fila["tipo"],$fila["precio"],$fila["pais"],$fila["foto"]);
                array_push($televisores,$tele);
            }
            echo "se obtuvieron todos los elementos de la base de datos<br>";
        }
        catch(PDOException $e)
        {
            echo "Error!!!\n" . $e->getMessage();
        }
        return $televisores;
    }
    public function CalcularIVA()
    {
        return $this->precio*1.21;
    }

    public function Eliminar()
    {
        $conStr='mysql:host=localhost;dbname=productos_bd';
        try
        {
            $pdo=new PDO($conStr,'root',"");
            $sentenciaPreparada=$pdo->prepare("DELETE FROM televisores WHERE tipo=:tipo AND precio=:precio AND pais=:pais AND foto=:foto");
            $sentenciaPreparada->execute(array("tipo"=>$this->tipo,"precio"=>$this->precio,"pais"=>$this->paisOrigen,"foto"=>$this->path));
            echo "se elimino exitosamente de la base de datos<br>";
        }
        catch(PDOException $e)
        {
        echo "Error!!!\n" . $e->getMessage();
        }
    }
}