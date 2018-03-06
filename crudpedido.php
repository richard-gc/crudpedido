<?php
!isset($_POST)?die("acesso denegado"): '';

require 'conexion.class.php';
$bd=new Conexion();

//Funcion para obtener data 
function getData($query) {
    $bd=new Conexion();
    $sql = $bd->query($query);    // query del formato "SELECT * FROM foods"
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

if(isset($_POST['registrar'])){
    $npedido=$_POST['npedido'];
    $area_id=$_POST['area_id'];
    $descripcion=$_POST['descripcion'];
    $cantidad=$_POST['cantidad'];
    $unidad=$_POST['unidad'];
    $tipo=$_POST['tipo'];
    $cod_ppto=$_POST['cod_ppto'];
    $cod_pondihma=$_POST['cod_pomdihma'];
    $fecha=$_POST['fecha'];
    $seguimiento=$_POST['seguimiento'];
    $costo_estimado=$_POST['costo_estimado'];
    $costo_real=$_POST['costo_real'];
        if(empty($npedido)||$area_id==0||empty($descripcion)||empty($cantidad)||empty($unidad)||empty($tipo)
        ||empty($cod_ppto)||empty($cod_pondihma)||empty($fecha)||empty($costo_estimado)||empty($seguimiento)){
            header("location: pedido.php?error=falta un dato");
        }else{
         if(!is_numeric($npedido) ||!is_numeric($cantidad)||!is_numeric($costo_estimado)){
                    header("location: pedido.php?error= algunos datos deben ser numericos");
         }else {
            if(is_numeric($descripcion)||is_numeric($unidad)||is_numeric($tipo)||is_numeric($seguimiento)){
                        header("location: pedido.php?error=datos incorrectos");
             }else{
                $squery="INSERT INTO `pedido`(`npedido`, `area_id`, `descripcion`, `cantidad`, `unidad`, `tipo`,
                `cod_ppto`, `cod_pomdihma`, `fecha`,  `seguimiento`, `costo_estimado`, `costo_real`) 
               VALUES ('$npedido','$area_id','$descripcion','$cantidad','$unidad','$tipo','$cod_ppto',
               '$cod_pondihma','$fecha', '$seguimiento','$costo_estimado','$costo_real')";
               $bd->query($squery);
                   if($bd->affected_rows>0){
                     header("location: pedido.php?");
                    }
            }  
        } 
    }
}
if(isset($_POST['buscar'])){
    $npedido=$_POST['npedido'];
    $area_id=$_POST['area_id'];
    $tipo=$_POST['tipo'];
    $cod_pomdihma=$_POST['cod_pomdihma'];
    $fecha=$_POST['fecha'];
    $mes=substr($fecha, 5, 2);
    $squery='';
    if(!empty($npedido)){
        $squery="SELECT * FROM pedido WHERE npedido='$npedido'";
    }else{
        if(!empty($tipo)){
            $squery="SELECT * FROM pedido WHERE tipo='$tipo'";
        }else{
            if(!empty($cod_pomdihma)){
                $squery="SELECT * FROM pedido WHERE cod_pomdihma='$cod_pomdihma'";
            }else{
                if(!empty($fecha)&& $fecha=="0001-$mes-01"){
                    $squery="SELECT * FROM `pedido` WHERE `fecha` LIKE '%$mes%'";
                }else{
                    if(empty($npedido) && empty($tipo) && empty($cod_pomdihma) && empty($fecha) && ($area_id==0)){
                        $squery="SELECT * FROM pedido";
                    }else{
                        if(!empty($fecha)){
                            $squery="SELECT * FROM `pedido` WHERE `fecha`= '$fecha'";

                        }else{
                            $squery="SELECT * FROM pedido WHERE area_id='$area_id'";
                        }
                    }
                    }  
                }   
        }
    }
    $datos=getData($squery);
    echo(json_encode($datos));
 }

 if(isset($_POST['editar'])){
    $npedido=$_POST['npedido'];
    $area_id=$_POST['area_id'];
    $descripcion=$_POST['descripcion'];
    $cantidad=$_POST['cantidad'];
    $unidad=$_POST['unidad'];
    $tipo=$_POST['tipo'];
    $cod_ppto=$_POST['cod_ppto'];
    $cod_pomdihma=$_POST['cod_pomdihma'];
    $fecha=$_POST['fecha'];
    $fecha_atendido=$_POST['fecha_atendido'];
    $fecha_pc=$_POST['fecha_pc'];
    $seguimiento=$_POST['seguimiento'];
    $costo_estimado=$_POST['costo_estimado'];
    $costo_real=$_POST['costo_real'];
    $id=$_POST['id'];
    if($area_id==0){
        header("location: pedido.php?error=faltan dato");
    }else{
     if(!is_numeric($npedido) ||!is_numeric($cantidad)||!is_numeric($costo_estimado)||!is_numeric($costo_real)){
                header("location: pedido.php?error= algunos datos deben ser numericos");
     }else {
        if(is_numeric($descripcion)||is_numeric($unidad)||is_numeric($tipo)){
                    header("location: pedido.php?error=datos incorrectos");
         }else{
            $squery="UPDATE `pedido` SET `npedido`='$npedido',`area_id`='$area_id',`descripcion`='$descripcion',
            `cantidad`='$cantidad',`unidad`='$unidad',`tipo`='$tipo',`cod_ppto`='$cod_ppto',`cod_pomdihma`='$cod_pomdihma',
            `fecha`='$fecha',`fecha_atendido`='$fecha_atendido',`fecha_pc`='$fecha_pc', `seguimiento`='$seguimiento',`costo_estimado`='$costo_estimado',
            `costo_real`='$costo_real' WHERE npedido=$id";
           $bd->query($squery);
               if($bd->affected_rows>0){
                 header("location: pedido.php?");
                }else{
                    header("location: pedido.php?");
                }
        }  
    } 
}
}
?>
 