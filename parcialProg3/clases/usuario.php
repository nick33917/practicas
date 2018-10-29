<?php
class Usuario
{
    private $_email;
    private $_clave;

    public function __construct($email,$clave)
    {
        $this->_email=$email;
        $this->_clave=$clave;
    }

    public function ToJSON()
    {
         return json_encode(array("email"=>$this->_email,"clave"=>$this->_clave));
    }

    public function GuardarEnArchivo()
    {
        
        $archivo =fopen("archivos/usuarios.json","a+");

        $cant=fwrite($archivo,$this->ToJSON()."\r\n");

        if($cant>0)
        {
            return json_encode(array("exito"=>true,"mensaje"=>"se agrego correctamente"));
        }
        else
        {
            return json_encode(array("exito"=>false,"mensaje"=>"No se pudo agregar"));
        }
        fclose($archivo);
    }

    public static function TraerTodos()
    {
        
        $archivo =fopen("archivos/usuarios.json","r");
       $array=array();
        while(!feof($archivo))
        {
            $json=fgets($archivo);
            if($json!="")
            {
                $string=json_decode($json);
                $usuario= new Usuario($string->{'email'},$string->{'clave'});
                array_push($array,$usuario);
            }

        }
        fclose($archivo);
        return $array;

    }

    public static function VerificarExistencia($usuario)
    {
        $flag=false;
        $usuarioJson=json_decode($usuario->ToJSON());
        $array=Usuario::TraerTodos();
        
        foreach($array as $usr)
        {
            $usrJson=json_decode($usr->ToJSON());
            if($usrJson->{'email'} == $usuarioJson->{'email'})
            {
                $flag=true;
                break;
            }
        }
        
        return $flag;
    }
}