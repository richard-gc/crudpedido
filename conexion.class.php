<?php 
    require 'config/config.php';
 class Conexion extends Mysqli 
{
    public function __construct() 
    {
        parent::__construct(HOST, USER_NAME, PASS, BD_NAME);
        $this-> connect_error  ? die('error al conectar'):'';
    }

}
        
  // $bd=new Conexion();     
 ?>