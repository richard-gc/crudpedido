<?php
!isset($_POST)?die("acesso denegado"): '';

require 'conexion.class.php';
$bd=new Conexion();

if(isset($_POST['registrar'])){
    $area_id=$_POST['area_id'];
    $nombre=$_POST['nombre'];
    if(empty($area_id)||empty($nombre)) {
        header("location: area.php?error=falta un dato");
    }else{ 
            if(!is_numeric($area_id)){
                header("location: area.php?error=el ID debe ser un numero");
            }else{
                if(is_numeric($nombre)){
                    header("location: area.php?error=El nombre no puede ser un número");
                }
                else{
                    $query="INSERT INTO `area`(`area_id`, `nombre`) VALUES ('$area_id','$nombre')";
                    $bd->query($query);
                    if($bd->affected_rows>0){
                        header("location: area.php");
                    }else{
                        header("location: area.php");
                    }
                } 
            }
    }
}
if(isset($_POST['editar'])){
        $area_id=$_POST['area_id'];
        $nombre=$_POST['nombre'];
        $id=$_POST['id'];
        if(empty($area_id)||empty($nombre)) {
            header("location: area.php?error=falta un dato");
        }else{ 
                if(!is_numeric($area_id)){
                    header("location: area.php?error=el ID debe ser un numero");
                }else{
                    if(is_numeric($nombre)){
                        header("location: area.php?error=El nombre no puede ser un número");
                    }
                    else{
                        $query="UPDATE `area` SET `area_id`='$area_id',`nombre`='$nombre' WHERE area_id=$id ";
                        $bd->query($query);
                        if($bd->affected_rows>0){
                            header("location: area.php");
                        }else{
                            header("location: area.php");
                        }
                    } 
                }
        }
}
?>