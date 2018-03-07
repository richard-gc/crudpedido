<?php
  //requerimos el archivo execQuery
  require('functions/execQuery.php');
  //verificamos que los datos no estén vacíos.
  if( !empty($_POST['area_id']) and 
      !empty($_POST['cantidad']) and
      !empty($_POST['cod_pomdihma']) and
      !empty($_POST['cod_ppto']) and
      !empty($_POST['costo_estimado']) and
      !empty($_POST['costo_real']) and
      !empty($_POST['descripcion']) and
      !empty($_POST['fecha']) and
      !empty($_POST['fecha_atendido']) and
      !empty($_POST['fecha_pc']) and
      !empty($_POST['npedido']) and
      !empty($_POST['seguimiento']) and
      !empty($_POST['tipo']) and
      !empty($_POST['unidad']) 
    ){
    $area_id        =  $_POST['area_id'];
    $cantidad       =  $_POST['cantidad'];
    $cod_pomdihma   =  $_POST['cod_pomdihma'];
    $cod_ppto       =  $_POST['cod_ppto'];
    $costo_estimado =  $_POST['costo_estimado'];
    $costo_real     =  $_POST['costo_real'];
    $descripcion    =  $_POST['descripcion'];
    $fecha          =  $_POST['fecha'];
    $fecha_atendido =  $_POST['fecha_atendido'];
    $fecha_pc       =  $_POST['fecha_pc'];
    $npedido        =  $_POST['npedido'];
    $seguimiento    =  $_POST['seguimiento'];
    $tipo           =  $_POST['tipo'];
    $unidad         =  $_POST['unidad'];
    // verificamos que el id sea númerico
    if(!is_numeric($npedido) ||!is_numeric($cantidad)||!is_numeric($costo_estimado)){
      echo 1;
    //verificamos que el nombre no sea númerico
    }else if(is_numeric($descripcion)||is_numeric($unidad)||is_numeric($tipo)||is_numeric($seguimiento)){
      echo 2;
    }else{
      // realizamos la actualización, si es falsa me da un error 3
      if(!execQuery("UPDATE `pedido` SET `area_id`='$area_id',`descripcion`='$descripcion',
      `cantidad`='$cantidad',`unidad`='$unidad',`tipo`='$tipo',`cod_ppto`='$cod_ppto',`cod_pomdihma`='$cod_pomdihma',
      `fecha`='$fecha',`fecha_atendido`='$fecha_atendido',`fecha_pc`='$fecha_pc', `seguimiento`='$seguimiento',`costo_estimado`='$costo_estimado',
      `costo_real`='$costo_real' WHERE `npedido`='$npedido'")){
        echo 3;
      }else{
        // el valor 4 indica que se realizo la actualización
        echo 4;
      }
    }
    
  }else{
    echo 0;
  }
  /*
    0: Datos vacíos
    1: el ID no es número
    2: el nombre es un número
    3: error al actualizar
    4: actualización exitosa
  */
?>