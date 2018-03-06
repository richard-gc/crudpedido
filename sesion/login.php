<?php
    require '../conexion.class.php';
    function getData($query) {
        $bd=new Conexion();
        $sql = $bd->query($query); 
        if(mysqli_num_rows($sql) > 0){
            $return_array = array();
            while($row = mysqli_fetch_assoc($sql)){
                array_push($return_array,$row);
            }
            return $return_array;
        }else{
            return false;
        }
      }
      if($_POST){
        $user = $_POST['user'];
        $pass= $_POST['pass'];
        $squery = "SELECT user,pass FROM usuario WHERE user='$user' and pass='$pass'";
       $datos=getData($squery);
       if($datos){
        session_start();
        $_SESSION['dataUser'] = $datos;
        echo 1;
      }
        
      }
?>